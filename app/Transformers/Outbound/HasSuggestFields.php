<?php

namespace App\Transformers\Outbound;

trait HasSuggestFields
{

    protected function getSuggestFields()
    {
        return array_merge(parent::getSearchFields(), [

            'suggest_autocomplete_boosted' => [
                'doc' => 'Internal field to power the `/autocomplete` endpoint. Do not use directly.',
                'type' => 'object',
                'elasticsearch' => [
                    'type' => 'completion',
                    'analyzer' => 'article', // Custom: targets only `a`, `an`, `the`
                    'preserve_position_increments' => false, // Strips leading whitespace, leftover from articles
                ],
                'filter' => function ($item) {
                    return $item->isBoosted() && isset($item->title);
                },
                'value' => function ($item) {
                    return $item->title;
                },
            ],

            'suggest_autocomplete_all' => [
                'doc' => 'Internal field to power the `/autosuggest` endpoint. Do not use directly.',
                'type' => 'object',
                'elasticsearch' => [
                    'mapping' => [
                        'type' => 'completion',
                        'analyzer' => 'article', // Custom: targets only `a`, `an`, `the`
                        'preserve_position_increments' => false, // Strips leading whitespace, leftover from articles
                        'contexts' => [
                            [
                                'name' => 'groupings',
                                'type' => 'category', // accession, title, boosted
                            ],
                        ],
                    ],
                ],
                'filter' => function ($item) {
                    return isset($item->title);
                },
                'value' => function ($item) {
                    return [
                        'input' => [
                            $item->title
                        ],
                        'contexts' => [
                            'groupings' => [
                                'title',
                            ]
                        ],
                    ];
                },
            ],

        ]);
    }

}
