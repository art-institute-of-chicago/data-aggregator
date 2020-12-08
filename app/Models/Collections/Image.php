<?php

namespace App\Models\Collections;

/**
 * A pictorial representation of a collections resource, like an artwork, artist, exhibition, etc.
 */
class Image extends Asset
{

    protected static $assetType = 'image';

    protected $table = 'assets';

    protected $appends = ['iiif_url'];

    /**
     * Get the IIIF URL. Corresponds to the `@id` attribute in the image's `/info.json`
     *
     * @return string
     */
    public function getIiifUrlAttribute()
    {
        return env('IIIF_URL', 'https://localhost/iiif') . '/' . Asset::getHashedId($this->lake_guid);
    }

    public function searchableImage()
    {
        return $this->iiif_url;
    }
}
