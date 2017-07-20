<?php

namespace App\Models\Collections;

class Image extends Asset
{

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork');

    }

}
