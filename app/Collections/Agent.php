<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'citi_id';
    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at'];

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
