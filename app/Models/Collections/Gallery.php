<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

/**
 * A room or hall that works of art are displayed in.
 */
class Gallery extends CollectionsModel
{

    use ElasticSearchable;

    protected $primaryKey = 'citi_id';

    protected $casts = [
        'is_closed' => 'boolean',
    ];

    protected $touches = [
        'artworks',
    ];

    public function artworks()
    {

        return $this->hasMany('App\Models\Collections\Artwork');

    }

}
