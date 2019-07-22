<?php

namespace App\Transformers\Outbound;

trait HasSuggestFields
{

    protected function getSuggestFields()
    {
        return array_replace_recursive(parent::getSuggestFields(), [
            'suggest_autocomplete_boosted' => [
                'filter' => function ($item) {
                    return $item->isBoosted() && isset($item->title);
                },
            ],
            'suggest_autocomplete_all' => [
                'filter' => function ($item) {
                    return isset($item->title);
                },
            ],
        ]);
    }

}
