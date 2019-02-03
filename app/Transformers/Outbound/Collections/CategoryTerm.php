<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;

class CategoryTerm extends BaseTransformer
{

    protected function getFields()
    {
        return [
            'subtype' => [
                'doc' => 'Takes one of the following values: classification, material, technique, style, subject, department, theme',
                'type' => 'string',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    $mapping = [
                        $item::CLASSIFICATION => 'classification',
                        $item::MATERIAL => 'material',
                        $item::TECHNIQUE => 'technique',
                        $item::STYLE => 'style',
                        $item::SUBJECT => 'subject',
                        $item::DEPARTMENT => 'department',
                        $item::THEME => 'theme',
                    ];

                    return $mapping[$item->subtype] ?? null;
                },
            ],
            'parent_id' => [
                'doc' => 'Unique identifier of this category\'s parent',
                'type' => 'string',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->parent->lake_uid ?? null;
                },
            ]
        ];
    }

}
