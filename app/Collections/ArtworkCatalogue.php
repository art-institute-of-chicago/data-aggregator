<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class ArtworkCatalogue extends Model
{

    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['artwork_citi_id', 'catalogue', 'number', 'preferred', 'state_edition'];
    
}
