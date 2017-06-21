<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
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
    
    public function artist()
    {

        return $this->belongsTo('App\Collections\Artist');

    }

    public function categories()
    {

        return $this->belongsToMany('App\Collections\Category');

    }

}
