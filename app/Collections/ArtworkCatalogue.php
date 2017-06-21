<?php

namespace App\Collections;

class ArtworkCatalogue extends CollectionsModel
{

    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['artwork_citi_id', 'catalogue', 'number', 'preferred', 'state_edition'];
    
}
