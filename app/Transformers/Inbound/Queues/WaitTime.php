<?php

namespace App\Transformers\Inbound\Queues;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\Queues\WaitTime as WaitTimeModel;
use App\Transformers\Datum;
use App\Transformers\Inbound\BaseTransformer;

class WaitTime extends BaseTransformer
{
    public function shouldSave(Model $instance, $datum, $isNew = null)
    {
        return in_array($datum->queueId, array_keys(WaitTimeModel::$aicQueueIds));
    }

    protected function getIds(Datum $datum)
    {
        return [
            'id' => $datum->queueId,
        ];
    }

    protected function getTitle(Datum $datum)
    {
        return [
            'title' => WaitTimeModel::$aicQueueIds[$datum->queueId] ?? null,
        ];
    }

    protected function getExtraFields(Datum $datum)
    {
        return [
            'wait_display' => sprintf(
                '%s %s',
                $datum->waitTime,
                Str::plural('minutes', $datum->waitTime)
            ),
        ];
    }
}
