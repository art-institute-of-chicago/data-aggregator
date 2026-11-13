<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use App\Models\Changes\RecordChange;
use App\Transformers\Outbound\RecordChange as RecordChangeTransformer;
use Aic\Hub\Foundation\Exceptions\BigLimitException;
use Aic\Hub\Foundation\Exceptions\DetailedException;
use Aic\Hub\Foundation\Exceptions\TooManyIdsException;

/**
 * Lists entries from the change log, newest first.
 *
 * Query params:
 *  - `resource`: limit to one tracked endpoint, e.g. `artworks`
 *  - `ids`: comma-separated record ids, e.g. for an artwork's RSS feed
 *  - `since`: only changes detected on or after this date, e.g. for a weekly digest
 */
class ChangeController extends AbstractController
{
    protected $model = RecordChange::class;

    protected $transformer = RecordChangeTransformer::class;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function changes(Request $request)
    {
        $this->validateMethod($request);

        $limit = $request->input('limit') ?: 12;

        if (Gate::denies('restricted-access') && $limit > static::LIMIT_MAX) {
            throw new BigLimitException();
        }

        $trackedEndpoints = app('Resources')->getTrackedEndpoints();
        $resource = $request->input('resource');

        if ($resource && !in_array($resource, $trackedEndpoints)) {
            throw new DetailedException(
                'Invalid resource',
                'Changes are only tracked for: ' . implode(', ', $trackedEndpoints),
                400
            );
        }

        $query = RecordChange::query()
            ->whereIn('resource', $resource ? [$resource] : $trackedEndpoints)
            ->orderBy('detected_at', 'desc')
            ->orderBy('id', 'desc');

        if ($ids = $request->input('ids')) {
            $ids = explode(',', $ids);

            if (Gate::denies('restricted-access') && count($ids) > static::LIMIT_MAX) {
                throw new TooManyIdsException();
            }

            $query->whereIn('record_id', $ids);
        }

        if ($since = $request->input('since')) {
            try {
                $query->since(Carbon::parse($since));
            } catch (\Exception $e) {
                throw new DetailedException('Invalid date', 'Could not parse `since` as a date', 400);
            }
        }

        return $this->getCollectionResponse($query->paginate($limit), $request);
    }
}
