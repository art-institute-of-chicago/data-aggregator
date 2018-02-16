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

    /**
     * Scope a query to only include categories that represent departments
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDepartments($query)
    {

        return $query->where('type', 1)->where('parent_id', null);

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [
            [
                "name" => 'parent_id',
                "doc" => "Unique identifier of this category's parent",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->parent ? $this->parent->citi_id : null; },
            ],
            [
                "name" => 'is_in_nav',
                "doc" => "Whether this category was included in the departmental navigation in the old collections site",
                "type" => "boolean",
                'elasticsearch_type' => 'boolean',
                "value" => function() { return (bool) $this->is_in_nav; }
            ],
            [
                "name" => 'description',
                "doc" => "Explanation of what this category is",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->description; }
            ],
            [
                "name" => 'sort',
                "doc" => "Number representing this category's sort order",
                "type" => "number",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->sort; }
            ],
            [
                "name" => 'type',
                "doc" => "Number representing the type of category. 1 is departmental, 2 is subject, 3 is theme, 5 is multimedia.",
                "type" => "number",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->type; }
            ],
        ];

    }


    /**
     * Turn the titles for related models into a generic array
     *
     * @return array
     */
    protected function transformTitles()
    {

        return [

            [
                "name" => 'parent_title',
                "doc" => "Name of this category's parent",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->parent ? $this->parent->title : null; },
            ]

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
