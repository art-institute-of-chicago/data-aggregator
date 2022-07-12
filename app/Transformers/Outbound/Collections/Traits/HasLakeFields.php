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
                    return Asset::getHashedId($item->id);
                },
            ],
        ]);
    }

    protected function getDates()
    {
        $dates = parent::getDates();

        $dates['source_updated_at']['doc'] = 'Date and time the resource was updated in the LAKE LPM Solr index, which is our direct source of data';
        $dates['source_updated_at']['value'] = $this->getDateValue('source_indexed_at');

        return $dates;
    }
}
