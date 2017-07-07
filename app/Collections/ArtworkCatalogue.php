<?php

namespace App\Collections;

class ArtworkCatalogue extends CollectionsModel
{

    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['artwork_citi_id', 'catalogue', 'number', 'preferred', 'state_edition'];
    
}
