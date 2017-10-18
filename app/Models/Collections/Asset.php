<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * A binary representation of a collections resource, like an artwork, artist, exhibition, etc.
 */
class Asset extends CollectionsModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'lake_guid';
    protected $keyType = 'string';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at'];

    public function artist()
    {

        return $this->belongsTo('App\Models\Collections\Artist', 'agent_citi_id');

    }

    public function categories()
    {

        return $this->belongsToMany('App\Models\Collections\Category');

    }

    public function getFillFieldsFrom($source)
    {

        return [
            'description' => $source->description,
            'content' => $source->content,
            'published' => $source->published,
        ];

    }

    public function attachFrom($source, $fake = true)
    {

        if ($source->artist_id)
        {

            $artist = Artist::findOrCreate($source->artist_id);
            $this->artist()->associate($artist);

        }

        return $this;

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return array_merge(
            [
                // @TODO Make Images non-assets on CDS and DA? Currently, these transformations aren't defensive,
                // i.e. if these fields are missing from the CDS response, this will throw an error.

                // Potential defensive approach:
                // 'description' => isset( $this->description ) ? $this->description : null,
                // 'content' => isset( $this->content ) ? $this->content : null,

                'description' => [
                    "doc" => "Explanation of what this asset is",
                    "value" => function() { return $this->description; },
                ],
                'content' => [
                    "doc" => "Text of URL of the contents of this asset",
                    "value" => function() { return $this->content; },
                ],
                // @TODO Review whether to default to empty string or null.
                'artist' => [
                    "doc" => "Name of the artist associated with this asset",
                    "value" => function() { return $this->artist()->getResults() ? $this->artist()->getResults()->title : ''; },
                ],
                'artist_id' => [
                    "doc" => "Unique identifier of the artist associated with this asset",
                    "value" => function() { return $this->agent_citi_id; },
                ],
                'category_ids' => [
                    "doc" => "Unique identifier of the categories associated with this asset",
                    "value" => function() { return $this->categories->pluck('citi_id')->all(); },
                ],
            ],
            $this->transformAsset()
        );

    }

    /**
     * Provide a way for child classes add fields to the transformation.
     *
     * @return array
     */
    public function transformAsset()
    {

        return [];

    }

    /**
     * Turn the titles for related models into a generic array
     *
     * @return array
     */
    protected function transformTitles()
    {

        return [

            'category_titles' => $this->categories->pluck('title')->all(),

        ];

    }

    /**
     * Generate model-specific fields for an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMappingFields()
    {

        return
            [
                'content' => [
                    'type' => 'text',
                ],
                'artist' => [
                    'type' => 'text',
                ],
                'artist_id' => [
                    'type' => 'integer',
                ],
                'category_ids' => [
                    'type' => 'integer',
                ],
                'category_titles' => [
                    'type' => 'text',
                ],
            ];

    }

}
