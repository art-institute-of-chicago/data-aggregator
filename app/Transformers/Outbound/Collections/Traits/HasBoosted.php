<?php

namespace App\Transformers\Outbound\Collections\Traits;

trait HasBoosted
{

    protected function getSearchFields()
    {
        return array_merge(parent::getSearchFields(), [
            'is_boosted' => [
                'doc' => 'Whether this document should be boosted in search',
                'type' => 'boolean',
                'value' => function ($item) {
                    return $item->isBoosted();
                },
            ],
        ]);
    }
}
