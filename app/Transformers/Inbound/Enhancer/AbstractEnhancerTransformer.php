<?php

namespace App\Transformers\Inbound\Enhancer;

use App\Transformers\Datum;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\Inbound\BaseTransformer;

abstract class AbstractEnhancerTransformer extends BaseTransformer
{
    public static $sourceLastUpdateDateField = 'updated_at';

    protected $passthrough = false;

    public function shouldSave(Model $instance, $datum, $isNew = null)
    {
        return !$isNew;
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
