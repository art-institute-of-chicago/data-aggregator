<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

class Category extends CollectionsModel
{

    use ElasticSearchable;
    use Documentable;

    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    /**
     * The artworks that belong to the category.
     */
    public function artworks()
    {
        return $this->belongsToMany('App\Models\Collections\Artwork');
    }

    public function getFillFieldsFrom($source)
    {

        return [
            'description' => $source->description,
            'is_in_nav' => $source->is_in_nav,
            'parent_id' => $source->parent_id,
            'sort' => $source->sort,
            'type' => $source->type,
        ];

    }

    /**
     * Turn this model object into a generic array.
     *
     * @return array
     */
    public function transformFields()
    {

        return [
            'parent_id' => $this->parent_id,
            'is_in_nav' => (bool) $this->is_in_nav,
            'description' => $this->description,
            'sort' => $this->sort,
            'type' => $this->type,
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
                'is_in_nav' => [
                    'type' => 'boolean',
                ],
                'parent_id' => [
                    'type' => 'integer',
                ],
                'parent_title' => [
                    'type' => 'text',
                ],
                'sort' => [
                    'type' => 'integer',
                ],
                'type' => [
                    'type' => 'keyword',
                ],
            ];

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "3";

    }

}
