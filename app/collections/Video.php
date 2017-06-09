<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $primaryKey = 'citi_id';
    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at'];

    public function artists()
    {
        return $this->hasMany('App\Collections\Artist');
    }
}
