<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;

class ApiTransformer extends TransformerAbstract
{

    public $citiObject = false;
    public $excludeIdsAndTitle = false;
    public $excludeDates = false;

    /**
     * Turn this item object into a generic array.
     *
     * @param  Illuminate\Database\Eloquent\Model  $item
     * @return array
     */
    public function transform($item)
    {

        return array_merge(
            $this->transformIdsAndTitle($item),
            $this->transformFields($item),
            $this->transformDates($item)
        );

    }

    protected function transformFields($item)
    {

        return [];

    }


    protected function transformIdsAndTitle($item)
    {

        if ($this->excludeIdsAndTitle)
        {

            return [];

        }

        return [
            'id' => $item->getAttributeValue($item->getKeyName()),
            'title' => $item->title,
        ];
        
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
                'created_citi' => $item->citi_created_at->toDateTimeString(),
                'last_updated_citi' => $item->citi_modified_at->toDateTimeString(),
            ];

        }

        return array_merge(
            $ret,
            [
                'last_updated_lpm_fedora' => $item->api_modified_at->toDateTimeString(),
                'last_updated_lpm_solr' => $item->api_indexed_at->toDateTimeString(),
                'last_updated' => $item->updated_at->toDateTimeString(),
            ]
        );

    }   

}