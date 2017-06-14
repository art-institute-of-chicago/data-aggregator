<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $primaryKey = 'lake_guid';
    protected $keyType = 'string';
    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['citi_id', 'title', 'lake_guid', 'lake_uri'];

}
