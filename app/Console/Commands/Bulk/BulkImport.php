<?php

namespace App\Console\Commands\Bulk;

use Illuminate\Support\Facades\DB;
use App\Models\Collections\Artwork;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class BulkImport extends BaseCommand
{

    protected $signature = 'bulk:import
                            {source : Name of dataservice to query}
                            {endpoint : Endpoint on dataservice to import}
                            {ids? : Comma-separated ids to import}';

    protected $description = "Upsert resources from a data service";

    protected $chunkSize = 100; // Approx. 5 sec per 100 artworks

    protected $urlFormat;

    protected $tableMapping;

    public function handle()
    {
        $source = config('resources.sources.' . $this->argument('source'));
        $resource = config('resources.inbound.' . $this->argument('source') . '.' . $this->argument('endpoint'));

        $endpoint = $this->argument('endpoint');
        $ids = $this->argument('ids');

        $model = new $resource['model'];
        $table = $model->getTable();

        $transformer = new $resource['transformer'];

        // Query for the first page + get total
        // Limit has to be 1 due to a few 🐞's
        $json = $this->query($source, $endpoint, 1, 1, $ids);

        // Assumes the dataservice has standardized pagination
        $total = $json->pagination->total;
        $totalPages = ceil($total / $this->chunkSize);

        $bar = $this->output->createProgressBar($total);

        for ($currentPage = 1; $currentPage <= $totalPages; $currentPage++)
        {
            $json = $this->query($source, $endpoint, $currentPage, $this->chunkSize, $ids);

            $data = collect($json->data)->map(function($datum) use ($transformer, $table) {
                return [
                    'fill' => $transformer->getFill($table, $datum),
                    'sync' => [
                        'id' => $transformer->getId($datum),
                        'relations' => $transformer->getSyncNew($datum),
                    ],
                    'syncEx' => $transformer->getSyncExNew($datum),
                ];
            });

            // TODO: Take care of date and JSON columns in transformer?
            $fills = $data->pluck('fill')->map(function($datum) use ($model) {
                $clone = clone $model;
                array_map([$clone, 'setAttribute'], array_keys($datum), array_values($datum));
                return $clone->getAttributes();
            });

            // Manually append timestamps
            $now = date("Y-m-d H:i:s");
            $fills = $fills->map(function($datum) use ($now) {
                return array_merge($datum, [
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            });

            // Flatten relations, index by table name. Please refactor me.
            $syncs = $data->pluck('sync')->map(function($datum) use ($model) {
                $relations = collect($datum['relations'])->map(function($items, $relationMethod) use ($model, $datum) {
                    $relation = $model->$relationMethod();
                    return [
                        $relation->getTable() => collect($items)->map(function($value, $key) use ($relation, $datum) {
                            return is_array($value) ? array_merge([
                                $relation->getForeignPivotKeyName() => $datum['id'],
                                $relation->getRelatedPivotKeyName() => $key,
                            ], $value) : [
                                $relation->getForeignPivotKeyName() => $datum['id'],
                                $relation->getRelatedPivotKeyName() => $value,
                            ];
                        })->values()->all(),
                    ];
                })->values();

                if ($relations->count() < 1) {
                    return $relations;
                }

                $tables = array_unique(array_merge(...array_map('array_keys', $relations->all())));

                return collect($tables)->map(function($table) use ($relations) {
                    $values = $relations->pluck($table)->filter()->all();
                    return [
                        $table => empty($values) ? [] : array_merge(...$values),
                    ];
                })->collapse();
            });

            $syncEx = $data->pluck('syncEx');
            $syncs = $syncs->map(function($datum, $key) use ($syncEx) {
                return $datum->merge($syncEx->get($key));
            });

            // Merge an indexed collection of assoc. collections w/o overwriting
            $syncs = ($syncs->first() ?? collect([]))->map(function($items, $table) use ($syncs) {
                return $syncs->pluck($table)->collapse()->all();
            });

            $inserts = array_merge([$table => $fills->all()], $syncs->all());

            foreach ($inserts as $tableName => $items) {
                $this->upsert($tableName, $items);
            }

            $bar->advance(count($data));
        }

        $bar->finish();
        $this->output->newLine(1);
    }

    /**
     * @link https://gist.github.com/VinceG/0fb570925748ab35bc53f2a798cb517c
     */
    protected function upsert($tableName, $items)
    {
        try {
            DB::table($tableName)->insertUpdate($items);
        } catch (\Illuminate\Database\QueryException $e) {
            // SQLSTATE[08S01]: Communication link failure: 1153 Got a packet bigger than 'max_allowed_packet' bytes
            if ($e->errorInfo[1] === 1153) {
                array_map(function ($subitems) use ($tableName) {
                    $this->upsert($tableName, $subitems);
                }, array_chunk($items, ceil(count($items) / 2)));
            } else {
                throw $e;
            }
        }
    }

    protected function query($source, $endpoint, $page, $limit, $ids = null)
    {
        return json_decode($this->fetch(sprintf($this->getUrlFormat(), $source, $endpoint, $page, $limit, $ids)));
    }

    protected function getUrlFormat()
    {
        // Prep URL $format for sprintf calls
        return $this->urlFormat ?? $this->urlFormat = '%s/%s?' . urldecode(http_build_query([
            'page' => '%d',
            'limit' => '%d',
            'ids' => '%s',
        ]));
    }

    protected function fetch($file, &$headers = null)
    {
        if(!$contents = @file_get_contents($file))
        {
            // throw new \Exception('Fetch failed: ' . $file);

            sleep(90);
            return $this->fetch(...func_get_args());
        }

        if (isset($http_response_header))
        {
            $headers = $http_response_header;
        }

        return $contents;
    }

}
