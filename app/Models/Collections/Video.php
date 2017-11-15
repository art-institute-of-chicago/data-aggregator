<?php

namespace App\Models\Collections;

/**
 * A moving image representation of a collections resource, like an artwork, artist, exhibition, etc.
 */
class Video extends Asset
{

    protected $table = 'assets';

    /**
     * Filters the `assets` table by `type` to retrieve only videos.
     * Uses the inline method for scope definition, rather than creating new classes.
     *
     * @link https://stackoverflow.com/questions/20701216/laravel-default-orderby
     *
     * {@inheritdoc}
     */
    protected static function boot() {

        parent::boot();

        static::addGlobalScope('videos', function ($builder) {
            $builder->where('type', '=', 'video');
        });

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "8199a3c6-99fa-582d-449a-bc9221db54da";

    }

}
