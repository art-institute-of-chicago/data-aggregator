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

    protected $casts = [
        'scale_factors' => 'array',
        'iiif_synced_at' => 'datetime',
    ];

    /**
     * Get the IIIF URL. Corresponds to the `@id` attribute in the image's `/info.json`
     *
     * @return string
     */
    public function getIiifUrlAttribute()
    {
        return config('aic.assets.iiif_url') . '/' . Asset::getHashedId($this->id);
    }

    public function searchableImage()
    {
        return $this->iiif_url;
    }
}
