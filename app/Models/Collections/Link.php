<?php

namespace App\Models\Collections;

/**
 * A website that represents a collections resource, like an artwork, artist, exhibition, etc.
 */
class Link extends Asset
{

    protected $table = 'assets';

    /**
     * Filters the `assets` table by `type` to retrieve only links.
     * Uses the inline method for scope definition, rather than creating new classes.
     *
     * @link https://stackoverflow.com/questions/20701216/laravel-default-orderby
     *
     * {@inheritdoc}
     */
    protected static function boot() {

        parent::boot();

        static::addGlobalScope('links', function ($builder) {
            $builder->where('type', '=', 'link');
        });

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "3990a5f5-2ae9-3c7b-2fb8-1b0438962cd3";

    }

}
