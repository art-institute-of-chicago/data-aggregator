<?php

namespace App\Collections;

class ArtworkCommittee extends CollectionsModel
{

    protected $dates = ['date', 'api_created_at', 'api_modified_at', 'api_indexed_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['artwork_citi_id', 'committee', 'date', 'action'];
    
}
