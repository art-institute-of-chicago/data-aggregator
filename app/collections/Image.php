<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class Image extends Asset
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'lake_guid', 'lake_uri', 'iiif_url'];

    public function artworks()
    {

        return $this->belongsToMany('App\Collections\Artwork');

    }

}
