<?php

namespace App\Models\Collections;

/**
 * A pictorial representation of a collections resource, like an artwork, artist, exhibition, etc.
 */
class Image extends Asset
{

    protected $table = 'assets';

    protected static $assetType = 'image';

    protected $appends = ['iiif_url'];

    /**
     * Turn this model object into a generic array.
     *
     * @TODO Image currently extends Asset, which means it contains IR fields.
     * However, only 1547 of 103518 images are interpretive resources.
     * We need to think more about abstracting away these shared fields.
     * Maybe think of Interpretive Resource as a container..?
     *
     * @return array
     */
    public function transformAsset()
    {

        return [

            'iiif_url' => [
                "doc" => "IIIF URL of this image",
                "value" => function() { return $this->iiif_url; },
            ],

        ];

    }

    /**
     * Get the IIIF URL. Corresponds to the `@id` attribute in the image's `/info.json`
     *
     * @TODO Currently, this redirects to a non-existent `info.json'
     *
     * @return string
     */
    public function getIiifUrlAttribute()
    {

        // return env('IIIF_URL', 'https://localhost/iiif') . '/' . $this->lake_guid . '/info.json';
        return env('IIIF_URL', 'https://localhost/iiif') . '/' . $this->lake_guid;

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "c972e5d7-0667-6904-d919-bbeefeae0a10";

    }

}
