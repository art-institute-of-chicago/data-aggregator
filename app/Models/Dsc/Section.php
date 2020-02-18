<?php

namespace App\Models\Dsc;

use App\Models\DscModel;
use App\Models\ElasticSearchable;

/**
 * Represents a chapter of publication.
 */
class Section extends DscModel
{

    use ElasticSearchable;

    protected $touches = [
        'artwork',
    ];

    public function publication()
    {
        return $this->belongsTo('App\Models\Dsc\Publication');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Dsc\Section', 'parent_id');
    }

    public function artwork()
    {
        return $this->belongsTo('App\Models\Collections\Artwork', 'artwork_citi_id');
    }

}
