<?php

namespace App\Services;

use App\Models\Changes\RecordChange;
use App\Models\Changes\RecordSnapshot;
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Detects changes to the public API representation of records by diffing each record's
 * outbound transform against its last snapshot, and writes what changed to `record_changes`.
 *
 * Only public fields are tracked: the transformer is instantiated with restricted fields
 * stripped, and fields flagged `'track_changes' => false` in their definition are ignored.
 */
class ChangeTracker
{
    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var \App\Transformers\Outbound\AbstractTransformer
     */
    private $transformer;

    /**
     * Names of transformer fields that should never appear in the change log.
     *
     * @var array<string>
     */
    private $ignoredFields;

    public function __construct(string $endpoint)
    {
        $this->endpoint = $endpoint;

        $transformerClass = app('Resources')->getTransformerForEndpoint($endpoint);

        // Strip `is_restricted` fields, so nothing restricted is ever stored in the log
        $this->transformer = new $transformerClass(null, false, true);

        $this->ignoredFields = array_keys(array_filter(
            $this->transformer->getMappedFields(),
            fn ($field) => ($field['track_changes'] ?? true) === false
        ));
    }

    /**
     * Compare each item against its snapshot, log any changes, and update snapshots.
     * When `$isBaseline` is true, missing snapshots are written without logging anything.
     *
     * @param \Illuminate\Support\Collection<\Illuminate\Database\Eloquent\Model> $items
     * @return int  Number of change rows written
     */
    public function track(Collection $items, CarbonInterface $detectedAt, bool $isBaseline = false): int
    {
        $snapshots = RecordSnapshot::where('resource', $this->endpoint)
            ->whereIn('record_id', $items->map(fn ($item) => (string) $item->getKey()))
            ->get()
            ->keyBy('record_id');

        $changes = [];
        $upserts = [];

        foreach ($items as $item) {
            $recordId = (string) $item->getKey();
            $snapshot = $snapshots->get($recordId);

            // Transforming is the slow part, so let a resumed baseline skip records it already has
            if ($isBaseline && $snapshot) {
                continue;
            }

            $data = $this->getSnapshotData($item);
            $hash = md5(json_encode($data));

            if ($snapshot && $snapshot->hash === $hash) {
                continue;
            }

            if (!$isBaseline) {
                if (!$snapshot) {
                    $changes[] = $this->makeChange($recordId, RecordChange::CREATED, $detectedAt);
                } else {
                    foreach (self::diff($snapshot->data, $data) as $field => [$old, $new]) {
                        $changes[] = $this->makeChange($recordId, RecordChange::UPDATED, $detectedAt, $field, $old, $new);
                    }
                }
            }

            $upserts[] = [
                'resource' => $this->endpoint,
                'record_id' => $recordId,
                'hash' => $hash,
                'data' => json_encode($data),
                'created_at' => $detectedAt,
                'updated_at' => $detectedAt,
            ];
        }

        DB::transaction(function () use ($changes, $upserts) {
            foreach (array_chunk($changes, 500) as $chunk) {
                RecordChange::insert($chunk);
            }

            if ($upserts) {
                RecordSnapshot::upsert($upserts, ['resource', 'record_id'], ['hash', 'data', 'updated_at']);
            }
        });

        return count($changes);
    }

    /**
     * Log a `deleted` event for every snapshot whose record no longer exists, then drop those snapshots.
     *
     * @return int  Number of records found to be deleted
     */
    public function trackDeletions(CarbonInterface $detectedAt): int
    {
        $modelClass = app('Resources')->getModelForEndpoint($this->endpoint);
        $model = new $modelClass();

        $existingIds = $modelClass::query()
            ->withoutGlobalScopes()
            ->select($model->getKeyName());

        $deletedIds = RecordSnapshot::where('resource', $this->endpoint)
            ->whereNotIn('record_id', $existingIds)
            ->pluck('record_id');

        if ($deletedIds->isEmpty()) {
            return 0;
        }

        DB::transaction(function () use ($deletedIds, $detectedAt) {
            $changes = $deletedIds->map(fn ($recordId) => $this->makeChange($recordId, RecordChange::DELETED, $detectedAt));

            foreach ($changes->chunk(500) as $chunk) {
                RecordChange::insert($chunk->values()->all());
            }

            foreach ($deletedIds->chunk(500) as $chunk) {
                RecordSnapshot::where('resource', $this->endpoint)
                    ->whereIn('record_id', $chunk)
                    ->delete();
            }
        });

        return $deletedIds->count();
    }

    /**
     * Return the fields that differ between two snapshots, as `field => [old, new]`.
     * A field missing from one side (e.g. due to a transformer `filter`) is treated as null.
     *
     * @return array<string, array{0: mixed, 1: mixed}>
     */
    public static function diff(array $old, array $new): array
    {
        $diff = [];

        foreach (array_unique(array_merge(array_keys($old), array_keys($new))) as $field) {
            $oldValue = $old[$field] ?? null;
            $newValue = $new[$field] ?? null;

            if ($oldValue !== $newValue) {
                $diff[$field] = [$oldValue, $newValue];
            }
        }

        return $diff;
    }

    /**
     * Transform the item into its public API representation, minus ignored fields.
     * Round-trips through JSON so values compare the same way they're stored.
     */
    private function getSnapshotData($item): array
    {
        $data = $this->transformer->transform($item);
        $data = array_diff_key($data, array_flip($this->ignoredFields));

        return json_decode(json_encode($data), true);
    }

    private function makeChange(string $recordId, string $event, CarbonInterface $detectedAt, ?string $field = null, $old = null, $new = null): array
    {
        return [
            'resource' => $this->endpoint,
            'record_id' => $recordId,
            'event' => $event,
            'field' => $field,
            'old_value' => is_null($old) ? null : json_encode($old),
            'new_value' => is_null($new) ? null : json_encode($new),
            'detected_at' => $detectedAt,
        ];
    }
}
