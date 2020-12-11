<?php

namespace App\Transformers\Outbound\Collections\Traits;

use App\Models\Collections\Asset;

trait HasLakeFields
{

    protected function getIds()
    {
        $parentIds = parent::getIds();

        $parentIds['id']['value'] = function ($item) {
            $id = $item->getAttributeValue($item->getKeyName());
            return Asset::getHashedId($id);
        };

        return array_merge($parentIds, [
            'lake_guid' => [
                'doc' => 'Unique UUID of this resource in LAKE, our DAMS.',
                'type' => 'uuid',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return Asset::getHashedId($item->lake_guid);
                },
            ],
        ]);
    }

    protected function getDates()
    {
        $dates = parent::getDates();

        $dates['last_updated_source']['doc'] = 'Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data';
        $dates['last_updated_source']['value'] = $this->getDateValue('source_indexed_at');

        return $dates;
    }
}
