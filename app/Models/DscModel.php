<?php

namespace App\Models;

use App\Models\BaseModel;

class DscModel extends BaseModel
{

    public $incrementing = false;
    protected $primaryKey = 'dsc_id';
    protected $dates = ['source_created_at', 'source_modified_at'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
