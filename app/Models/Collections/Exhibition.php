<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

/**
 * An organized presentation and display of a selection of artworks.
 */
class Exhibition extends CollectionsModel
{

    use ElasticSearchable;

    protected $primaryKey = 'citi_id';

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
        'date_aic_start' => 'datetime',
        'date_aic_end' => 'datetime',
    ];

    public function artworks()
    {

        return $this->belongsToMany('App\Models\Collections\Artwork');

    }

    public function gallery()
    {

        return $this->belongsTo('App\Models\Collections\Gallery', 'place_citi_id');

    }

    public function sites()
    {

        return $this->belongsToMany('App\Models\StaticArchive\Site');

    }

    public function legacyEvents()
    {

        return $this->belongsToMany('App\Models\Membership\LegacyEvent', 'legacy_event_exhibition');

    }


    public function webExhibition()
    {

        return $this->hasOne('App\Models\Web\Exhibition', 'datahub_id');

    }

    // TODO: Consider using hasManyThrough() or belongsToMany()->using()
    public function getArtistsAttribute()
    {

        return $this->sites->pluck('agents')->collapse()->unique();

    }

    // TODO: These relations are shared w/ artwork – consider moving them to e.g. Behaviors/HasRepAndDoc.php?
    // The only thing that changes is the pivot table – artwork_asset vs. exhibition_asset

    // SOF HasRepAndDoc --------------->

    public function images()
    {

        return $this->belongsToMany('App\Models\Collections\Asset', 'exhibition_asset')
            ->where('type', 'image') // Do we need these if we're targeting Image i/o Asset?
            ->withPivot('preferred')
            ->withPivot('is_doc')
            ->wherePivot('is_doc', '=', false);

    }

    public function image()
    {

        return $this->images()->isPreferred();

    }

    public function altImages()
    {

        return $this->images()->isAlternative();

    }

    public function assets()
    {

        return $this->belongsToMany('App\Models\Collections\Asset', 'exhibition_asset')->withPivot('is_doc');

    }

    public function documents()
    {

        return $this->assets()->wherePivot('is_doc', '=', true);

    }

    // EOF HasRepAndDoc --------------->

}
