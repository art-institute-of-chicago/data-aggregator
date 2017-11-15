<?php

namespace App\Models\Collections;

/**
 * Text that represents a collections resource, like an artwork, artist, exhibition, etc.
 */
class Text extends Asset
{

    protected $table = 'assets';

    /**
     * Filters the `assets` table by `type` to retrieve only texts.
     * Uses the inline method for scope definition, rather than creating new classes.
     *
     * @link https://stackoverflow.com/questions/20701216/laravel-default-orderby
     *
     * {@inheritdoc}
     */
    protected static function boot() {

        parent::boot();

        static::addGlobalScope('texts', function ($builder) {
            $builder->where('type', '=', 'text');
        });

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "28f4641e-c040-7669-6036-f6fce1e25514";

    }

}
