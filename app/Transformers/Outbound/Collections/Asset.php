<?php

namespace App\Transformers\Outbound\Collections;

use App\Transformers\Outbound\Collections\Traits\HasLakeFields;

use App\Transformers\Outbound\CollectionsTransformer as BaseTransformer;

class Asset extends BaseTransformer
{
    use HasLakeFields;

    /**
     * LAKE-native resources use UUIDs, not integers.
     *
     * @var string
     */
    protected $keyType = 'keyword';

    protected function getFields()
    {
        $sharedFields = [
            'type' => [
                'doc' => 'Type always takes one of the following values: image, sound, text, video',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'description' => [
                'doc' => 'Explanation of what this asset is',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'alt_text' => [
                'doc' => 'Alternative text for the asset to describe it to people with low or no vision',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'content' => [
                'doc' => 'Text of or URL to the contents of this asset',
                'type' => 'string',
                'elasticsearch' => [
                    'default' => true,
                ],
            ],
            'copyright_notice' => [
                'doc' => 'Statement notifying how the asset is protected by copyright. Applies to the asset itself, not artwork it may be related to.',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'is_multimedia_resource' => [
                'doc' => 'Whether this resource is considered to be multimedia',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'is_educational_resource' => [
                'doc' => 'Whether this resource is considered to be educational',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'is_teacher_resource' => [
                'doc' => 'Whether this resource is considered to be educational',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'content_e_tag' => [
                'doc' => 'Arbitrary unique identifier that changes when the binary file gets updated',
                'type' => 'string',
                'elasticsearch' => 'keyword',
            ],
            'content_modified_at' => [
                'doc' => 'Date and time the associated binary file was updated',
                'type' => 'ISO 8601 date and time',
                'elasticsearch' => 'date',
                'value' => $this->getDateValue('content_modified_at'),
            ],
        ];

        // TODO: Refactor relationships:
        $relationshipFields = [
            'artwork_ids' => [
                'doc' => 'Unique identifiers of the artworks associated with this asset',
                'type' => 'array',
                'elasticsearch' => 'integer',
                'value' => function ($item) {
                    return $item->artworks->pluck('citi_id');
                },
            ],
            'artwork_titles' => [
                'doc' => 'Names of the artworks associated with this asset',
                'type' => 'array',
                'elasticsearch' => 'text',
                'value' => function ($item) {
                    return $item->artworks->pluck('title');
                },
            ],
        ];

        return array_merge(
            $sharedFields,
            $this->getAssetFields(),
            $relationshipFields
        );
    }

    /**
     * Provide a way for child classes to add fields to the transformation.
     *
     * @return array
     */
    protected function getAssetFields()
    {
        return [];
    }

}
