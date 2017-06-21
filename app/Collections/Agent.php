<?php

namespace App\Collections;

class Agent extends CollectionsModel
{

    public $incrementing = false;
    protected $primaryKey = 'citi_id';
    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at', 'citi_created_at', 'citi_modified_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['citi_id', 'title', 'lake_guid', 'lake_uri'];

    public function artworks()
    {
        return $this->hasMany('App\Collections\Artwork');
    }

    public function agentType()
    {

        return $this->belongsTo('App\Collections\AgentType');

    }

}
