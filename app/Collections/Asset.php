<?php

namespace App\Collections;

class Asset extends CollectionsModel
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
    
    public function artist()
    {

        return $this->belongsTo('App\Collections\Artist');

    }

    public function categories()
    {

        return $this->belongsToMany('App\Collections\Category');

    }

}
