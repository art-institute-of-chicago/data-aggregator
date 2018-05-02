<?php

namespace App\Http\Transformers;

class DscTransformer extends ApiTransformer
{

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

}
