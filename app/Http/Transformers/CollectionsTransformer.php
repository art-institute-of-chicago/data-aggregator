<?php

namespace App\Http\Transformers;

class CollectionsTransformer extends ApiTransformer
{

    public $citiObject = false;

    protected function transformIdsAndTitle($item)
    {

        if ($this->excludeIdsAndTitle)
        {

            return [];

        }

        $ret = [
            'id' => $item->getAttributeValue($item->getKeyName()),
        ];

        $ret = array_merge($ret,
                           [
                               'title' => $item->title,
                           ]
        );

        if ($this->citiObject)
        {

            $ret = array_merge($ret,
                               [
                                   'lake_guid' => $item->lake_guid,
                               ]
            );
        }

        return $ret;

    }

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
                'last_updated_fedora' => $item->source_modified_at->toDateTimeString(),
                'last_updated_source' => $item->source_indexed_at->toDateTimeString(),
                'last_updated' => $item->updated_at->toDateTimeString(),
            ]
        );

    }   

}