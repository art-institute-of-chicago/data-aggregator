<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

class Asset extends CollectionsModel
{

    use ElasticSearchable;

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
     * Turn this model object into a generic array.
     *
     * @return array
     */
    public function transformFields()
    {

        return array_merge(
            [
                'description' => $this->description,
                'content' => $this->content,
                // @TODO Review whether to default to empty string or null. Solr indexes null as empty string!
                'artist' => $this->artist()->getResults() ? $this->artist()->getResults()->title : '',
                'artist_id' => $this->agent_citi_id,
                'category_ids' => $this->categories->pluck('citi_id')->all(),
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
