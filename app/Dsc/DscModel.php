<?php

namespace App\Dsc;

use Illuminate\Database\Eloquent\Model;

class DscModel extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'dsc_id';
    protected $dates = ['api_created_at', 'api_modified_at'];

}
