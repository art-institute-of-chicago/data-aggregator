<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\SolrSearchable;

class Category extends CollectionsModel
{

    use SolrSearchable;

    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at'];

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
     * @param boolean  $withTitles
     * @return array
     */
    public function transform($withTitles = false)
    {

        return [
            'parent_id' => $this->parent_id,
            'is_in_nav' => $this->is_in_nav,
            'description' => $this->description,
            'sort' => $this->sort,
            'type' => $this->type,
        ];

    }

}
