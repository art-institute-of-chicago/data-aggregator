<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Command extends Model
{

     protected $dates = ['last_ran_at'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
