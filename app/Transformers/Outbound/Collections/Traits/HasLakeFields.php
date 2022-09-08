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
}
