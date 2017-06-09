<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $primaryKey = 'citi_id';
    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at'];

    public function artworks()
    {
        return $this->hasMany('App\Collections\Artwork');
    }
}
