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

            [

                "name" => 'iiif_url',
                "doc" => "IIIF URL of this image",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->iiif_url; },
            ],
            'color' => [
                "doc" => "Dominant color of this image in HSL",
                "type" => "object",
                "value" => function() { return $this->metadata->color ?? null; },
            ],
            'fingerprint' => [
                "doc" => "Image hashes: aHash, dHash, pHash, wHash",
                "type" => "object",
                "value" => function() { return $this->metadata->fingerprint ?? null; },
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

    /**
     * Generate model-specific fields for an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMappingFields()
    {

        $original = parent::elasticsearchMappingFields();

        $additional = [
            'color' => [
                'type' => 'object',
                'properties' => [
                    'population' => [ 'type' => 'integer' ],
                    'percentage' => [ 'type' => 'float' ],
                    'h' => [ 'type' => 'integer' ],
                    's' => [ 'type' => 'integer' ],
                    'l' => [ 'type' => 'integer' ],
                ]
            ],
            // TODO: Elasticsearch is bad at string distance
            'fingerprint' => [
                'type' => 'object',
                'properties' => [
                    'ahash' => [ 'type' => 'keyword' ],
                    'dhash' => [ 'type' => 'keyword' ],
                    'phash' => [ 'type' => 'keyword' ],
                    'whash' => [ 'type' => 'keyword' ],
                ]
            ],
        ];

        return array_merge( $original, $additional );

    }

}
