<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'citi_id';
    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at'];

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

    public function galleries()
    {

        return $this->belongsToMany('App\Collections\Gallery');

    }
}
