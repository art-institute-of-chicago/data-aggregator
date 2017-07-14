<?php

namespace App\StaticArchive;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\SortByLastUpdatedScope;

class Site extends Model
{

    protected $primaryKey = 'site_id';
    protected $dates = ['source_created_at', 'source_modified_at'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected static function boot()
    {

        parent::boot();
        static::addGlobalScope(new SortByLastUpdatedScope());

    }

    public function exhibition()
    {

        return $this->belongsTo('App\Collections\Exhibition');

    }

    public function artworks()
    {

        return $this->belongsToMany('App\Collections\Artwork');

    }

}
