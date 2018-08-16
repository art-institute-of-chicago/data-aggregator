<?php

namespace App\Models\DigitalLabel;

use App\Models\DigitalLabelModel;
use App\Models\Documentable;

/**
 * An individual interactive label in our galleries.
 */
class Label extends DigitalLabelModel
{

    use Documentable;

    protected $table = 'digital_labels';

    protected $casts = [
        'published' => 'boolean',
    ];

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_digital_label', 'digital_label_id');

    }

    public function artists()
    {

        return $this->belongsToMany('App\Models\Collections\Agent', 'artist_digital_label', 'digital_label_id');

    }

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "593";

    }

}
