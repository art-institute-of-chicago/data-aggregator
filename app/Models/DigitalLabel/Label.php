<?php

namespace App\Models\DigitalLabel;

use App\Models\DigitalLabelModel;
use App\Models\ElasticSearchable;

/**
 * An individual interactive label in our galleries.
 */
class Label extends DigitalLabelModel
{

    use ElasticSearchable;

    protected $table = 'digital_labels';

    protected $casts = [
        'is_published' => 'boolean',
        'source_created_at' => 'datetime',
    ];

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork', 'artwork_digital_label', 'digital_label_id');

    }

    public function artists()
    {

        return $this->belongsToMany('App\Models\Collections\Agent', 'artist_digital_label', 'digital_label_id');

    }

    public function exhibition()
    {

        return $this->belongsTo('App\Models\DigitalLabel\Exhibition', 'digital_label_exhibition_id');

    }

}
