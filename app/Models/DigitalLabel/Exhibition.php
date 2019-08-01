<?php

namespace App\Models\DigitalLabel;

use App\Models\DigitalLabelModel;

/**
 * An exhibition in which a number of labels are featured.
 */
class Exhibition extends DigitalLabelModel
{

    protected $table = 'digital_label_exhibitions';

    protected $casts = [
        'is_published' => 'boolean',
        'source_created_at' => 'datetime',
    ];

    public function exhibition()
    {
        return $this->belongsTo('App\Models\Collections\Exhibition');
    }

    public function labels()
    {
        return $this->hasMany('App\Models\DigitalLabel\Label');
    }

}
