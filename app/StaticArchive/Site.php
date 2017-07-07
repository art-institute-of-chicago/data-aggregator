<?php

namespace App\StaticArchive;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{

    protected $primaryKey = 'site_id';
    protected $dates = ['source_created_at', 'source_modified_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'link'];

    public function exhibition()
    {

        return $this->belongsTo('App\Collections\Exhibition');

    }

    public function artworks()
    {

        return $this->belongsToMany('App\Collections\Artwork');

    }

}
