<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'lake_guid';
    protected $keyType = 'string';
    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'lake_guid', 'lake_uri'];

    /**
     * The artworks that belong to the category.
     */
    public function artworks()
    {
        return $this->belongsToMany('App\Collection\Artwork');
    }
}
