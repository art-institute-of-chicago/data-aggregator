<?php

namespace App\Collections;

class Artwork extends CollectionsModel
{

    public $incrementing = false;
    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['citi_id', 'title', 'lake_guid', 'lake_uri', 'main_id'];

    public function artists()
    {

        return $this->belongsToMany('App\Collections\Artist', 'agent_artwork', 'artwork_citi_id', 'agent_citi_id');

    }

    public function copyrightRepresentatives()
    {

        return $this->belongsToMany('App\Collections\CopyrightRepresentative', 'agent_artwork', 'artwork_citi_id', 'agent_citi_id');

    }

    public function department()
    {

        return $this->belongsTo('App\Collections\Department');

    }

    public function objectType()
    {

        return $this->belongsTo('App\Collections\ObjectType');

    }

    public function categories()
    {

        return $this->belongsToMany('App\Collections\Category');

    }

    public function dates()
    {

        return $this->hasMany('App\Collections\ArtworkDate');

    }

    public function committees()
    {

        return $this->hasMany('App\Collections\ArtworkCommittee');

    }

    public function terms()
    {

        return $this->hasMany('App\Collections\ArtworkTerm');

    }

    public function catalogues()
    {

        return $this->hasMany('App\Collections\ArtworkCatalogue');

    }

    public function gallery()
    {

        return $this->belongsTo('App\Collections\Gallery');

    }

    public function parts()
    {

        return $this->belongsToMany('App\Collections\Artwork', 'artwork_artwork', 'set_citi_id', 'part_citi_id');

    }

    public function sets()
    {

        return $this->belongsToMany('App\Collections\Artwork', 'artwork_artwork', 'part_citi_id', 'set_citi_id');

    }

    public function images()
    {

        return $this->belongsToMany('App\Collections\Image');

    }

    public function mobileArtwork()
    {

        return $this->hasOne('App\Mobile\Artwork');

    }

    public function mobileSounds()
    {

        return $this->belongsToMany('App\Mobile\Sound', 'artwork_mobile_app_sound', 'artwork_citi_id', 'mobile_app_sound_mobile_id');

    }

    public function tourStops()
    {

        return $this->hasMany('App\Mobile\TourStop');

    }

    public function tours()
    {

        return $this->belongsToMany('App\Mobile\Tour', 'tour_stops');

    }

    public function publications()
    {

        return $this->belongsToMany('App\Dsc\Publication', 'works_of_art');

    }

}
