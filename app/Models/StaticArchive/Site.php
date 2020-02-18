<?php

namespace App\Models\StaticArchive;

use App\Models\BaseModel;
use App\Models\ElasticSearchable;

/**
 * An archived static microsite.
 */
class Site extends BaseModel
{

    use ElasticSearchable;

    protected $primaryKey = 'site_id';

    protected $hasSourceDates = false;

    protected $touches = [
        'artworks',
    ];

    public function exhibitions()
    {
        return $this->belongsToMany('App\Models\Collections\Exhibition');
    }

    public function agents()
    {
        return $this->belongsToMany('App\Models\Collections\Agent');
    }

    public function artworks()
    {
        return $this->belongsToMany('App\Models\Collections\Artwork')->artworks();
    }

}
