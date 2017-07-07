<?php

namespace App\Collections;

class Exhibition extends CollectionsModel
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
    
    public function artworks()
    {

        return $this->belongsToMany('App\Collections\Artwork');

    }

    public function venues()
    {

        return $this->belongsToMany('App\Collections\CorporateBody', 'agent_exhibition', 'exhibition_citi_id', 'agent_citi_id');

    }

    public function department()
    {

        return $this->belongsTo('App\Collections\Department');

    }

    public function gallery()
    {

        return $this->belongsTo('App\Collections\Gallery');

    }

}
