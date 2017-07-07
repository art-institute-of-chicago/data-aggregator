<?php

namespace App\Mobile;

use Illuminate\Database\Eloquent\Model;

class MobileModel extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'mobile_id';
    protected $dates = ['source_created_at', 'source_modified_at'];

}
