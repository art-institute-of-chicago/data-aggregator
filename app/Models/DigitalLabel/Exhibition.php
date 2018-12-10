<?php

namespace App\Models\DigitalLabel;

use App\Models\DigitalLabelModel;
use App\Models\Documentable;

/**
 * An exhibition in which a number of labels are featured.
 */
class Exhibition extends DigitalLabelModel
{

    use Documentable;

    protected $table = 'digital_label_exhibitions';

    protected $casts = [
        'published' => 'boolean',
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
