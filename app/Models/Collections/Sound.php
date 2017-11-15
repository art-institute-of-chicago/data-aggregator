<?php

namespace App\Models\Collections;

/**
 * Audio that represents a collections resource, like an artwork, artist, exhibition, etc.
 */
class Sound extends Asset
{

    protected $table = 'assets';

    /**
     * Filters the `assets` table by `type` to retrieve only sounds.
     * Uses the inline method for scope definition, rather than creating new classes.
     *
     * @link https://stackoverflow.com/questions/20701216/laravel-default-orderby
     *
     * {@inheritdoc}
     */
    protected static function boot() {

        parent::boot();

        static::addGlobalScope('sounds', function ($builder) {
            $builder->where('type', '=', 'sound');
        });

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "0dc99580-0a4c-c047-31e9-f42d29ac020e";

    }

}
