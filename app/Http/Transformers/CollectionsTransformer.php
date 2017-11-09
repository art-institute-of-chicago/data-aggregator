<?php

namespace App\Http\Transformers;

class CollectionsTransformer extends ApiTransformer
{

    /**
     * Whether or not CITI is the system of record for this resource.
     *
     * @TODO Move this domain knowledge to models?
     *
     * @var boolean
     */
    public $citiObject = true;

    protected function transformIdsAndTitle($item)
    {

        if ($this->excludeIdsAndTitle)
        {

            return [];

        }

        $ret = [
            'id' => $item->getAttributeValue($item->getKeyName()),
        ];

        $ret = array_merge( $ret, [
            'title' => $item->title,
        ]);

        if ($this->citiObject)
        {

            $ret = array_merge( $ret, [
                'lake_guid' => $item->lake_guid,
            ]);
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
                'last_updated_citi' => $item->citi_modified_at->toIso8601String(),
            ];

        }

        return array_merge(
            $ret,
            [
                'last_updated_fedora' => $item->source_modified_at->toIso8601String(),
                'last_updated_source' => $item->source_indexed_at->toIso8601String(),
                'last_updated' => $item->updated_at->toIso8601String(),
            ]
        );

    }

}
