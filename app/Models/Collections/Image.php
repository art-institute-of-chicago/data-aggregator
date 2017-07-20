<?php

// @TODO Fix App\Collections to App\Models\Collections in model methods
namespace App\Models\Collections;

class Image extends Asset
{

    public function artworks()
    {

        return $this->belongsToMany('App\Collections\Artwork');

    }

}
