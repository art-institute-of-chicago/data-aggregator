<?php

namespace App\Collections;

class Category extends CollectionsModel
{

    public $incrementing = false;
    protected $primaryKey = 'lake_guid';
    protected $keyType = 'string';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'lake_guid', 'lake_uri'];

    /**
     * The artworks that belong to the category.
     */
    public function artworks()
    {
        return $this->belongsToMany('App\Collection\Artwork');
    }

}
