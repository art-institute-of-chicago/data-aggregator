<?php

namespace App\Collections;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $primaryKey = 'citi_id';
    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at'];
}
