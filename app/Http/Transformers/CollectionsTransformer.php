<?php

namespace App\Http\Transformers;

class CollectionsTransformer extends ApiTransformer
{

    public $citiObject = false;

    protected function transformDates($item)
    {

        if ($this->excludeDates)
        {

            return [];

        }

        $ret = [];

        if ($this->citiObject)
        {

            $ret = [
                'last_updated_citi' => $item->citi_modified_at->toDateTimeString(),
            ];

        }

        return array_merge(
            $ret,
            [
                'last_updated_fedora' => $item->api_modified_at->toDateTimeString(),
                'last_updated_source' => $item->api_indexed_at->toDateTimeString(),
                'last_updated' => $item->updated_at->toDateTimeString(),
            ]
        );

    }   

}