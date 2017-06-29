<?php

namespace App\Mobile;

class Tour extends MobileModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mobile_id', 'title'];

    public function intro()
    {

        return $this->belongsTo('App\Mobile\Sound', 'intro_mobile_id');

    }

    public function stops()
    {

        return $this->hasMany('App\Mobile\TourStop');

    }

}