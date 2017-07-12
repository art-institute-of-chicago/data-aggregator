<?php

namespace App\Collections;

class Image extends Asset
{

    public function artworks()
    {

        return $this->belongsToMany('App\Collections\Artwork');

    }

}
