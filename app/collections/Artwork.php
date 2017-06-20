<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'citi_id';
    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at', 'citi_created_at', 'citi_modified_at'];

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

}
