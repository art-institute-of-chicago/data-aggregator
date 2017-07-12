<?php

namespace App\Collections;

class Category extends CollectionsModel
{

    public $incrementing = false;
    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at'];

    /**
     * The artworks that belong to the category.
     */
    public function artworks()
    {
        return $this->belongsToMany('App\Collection\Artwork');
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

}
