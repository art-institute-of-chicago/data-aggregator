<?php

namespace App\Models\Collections;

// @TODO: Make Images not Assets, both in the CDS and the DA?
class Image extends Asset
{

    // Note: Not all Images are meant to be associated w/ Artworks
    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork');

    }

    // TODO: Attach artworks' titles to the Image for search

}
