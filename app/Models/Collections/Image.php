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

    /**
     * Turn this model object into a generic array.
     *
     * @return array
     */
    public function transformFields()
    {

        // Image currently extends Asset, so it contains the following fields:
        // description, content, artist, artist_id

        // However, these fields are "legacy" leftovers from Interpretive Resource
        // They will likely *not* be filled during the upcoming LPM Enhancements work

        // THerefore, we exclude them from this transformation

        return array_merge(
            [
                'artwork_titles' => $this->artworks()->pluck('title'),
            ]
        );
    }

}
