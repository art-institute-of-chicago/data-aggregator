<?php

namespace App\Mobile;

use Illuminate\Database\Eloquent\Model;

class MobileModel extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'mobile_id';
    protected $dates = ['api_created_at', 'api_modified_at'];

}
