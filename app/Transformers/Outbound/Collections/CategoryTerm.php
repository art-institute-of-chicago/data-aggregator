<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\HasSuggestFields;
use App\Transformers\Outbound\Collections\Traits\IsCC0;
use App\Transformers\Outbound\Collections\Traits\HasAatId;

use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;

class CategoryTerm extends BaseTransformer
{
    use IsCC0;
    use HasAatId;
    use HasSuggestFields {
        getSuggestFields as traitGetSuggestFields;
    }

    protected $keyType = 'keyword';

    protected function getFields()
    {
        return [
            'subtype' => [
                'doc' => 'Takes one of the following values: classification, material, technique, style, subject, department, theme',
                'type' => 'string',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->getSubtypeDisplay();
                },
            ],
            'parent_id' => [
                'doc' => 'Unique identifier of this category\'s parent',
                'type' => 'string',
                'elasticsearch' => 'keyword',
                'value' => function ($item) {
                    return $item->parent->lake_uid ?? null;
                },
            ],
        ];
    }

    /**
     * Omit `category-terms` from autosuggest if they have no artworks.
     * `category-terms` do not contribute to autocomplete.
     */
    protected function getSuggestFields()
    {
        $suggestFields = $this->traitGetSuggestFields();

        unset($suggestFields['suggest_autocomplete_boosted']);

        $oldFilter = $suggestFields['suggest_autocomplete_all']['filter'];
        $suggestFields['suggest_autocomplete_all']['filter'] = function ($item) use ($oldFilter) {
            return $oldFilter($item) && $item->artworks()->count() > 1;
        };

        return $suggestFields;
    }
}
