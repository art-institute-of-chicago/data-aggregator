<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

/**
 * Tag-like classifications of artworks and other resources.
 */
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

    public function parent()
    {
        return $this->belongsTo('App\Models\Collections\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Collections\Category', 'parent_id');
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
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            'parent_id' => [
                "doc" => "Unique identifier of this category's parent",
                "type" => "number",
                "value" => function() { return $this->parent ? $this->parent->citi_id : null; },
            ],
            'is_in_nav' => [
                "doc" => "Whether this category was included in the departmental navigation in the old collections site",
                "type" => "boolean",
                "value" => function() { return (bool) $this->is_in_nav; }
            ],
            'description' => [
                "doc" => "Explanation of what this category is",
                "type" => "string",
                "value" => function() { return $this->description; }
            ],
            'sort' => [
                "doc" => "Number representing this category's sort order",
                "type" => "number",
                "value" => function() { return $this->sort; }
            ],
            'type' => [
                "doc" => "Number representing the type of category. 1 is departmental, 2 is subject, 3 is theme, 5 is multimedia.",
                "type" => "number",
                "value" => function() { return $this->type; }
            ],
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
