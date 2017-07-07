<?php

namespace App\Collections;

class Theme extends CollectionsModel
{

    public $incrementing = false;
    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['citi_id', 'title', 'lake_guid', 'lake_uri'];

}
