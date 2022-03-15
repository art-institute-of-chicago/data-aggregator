<?php

namespace App\Transformers\Inbound\Enhancer;

use App\Transformers\Datum;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\Inbound\BaseTransformer;

abstract class AbstractEnhancerTransformer extends BaseTransformer
{
    protected $passthrough = false;

    public function shouldSave(Model $instance, $datum, $isNew = null)
    {
        return !$isNew;
    }

    protected function getIds(Datum $datum)
    {
        return [
            'citi_id' => $datum->id,
        ];
    }

    protected function getTitle(Datum $datum)
    {
        return [];
    }

    protected function getDates(Datum $datum)
    {
        return [];
    }
}
