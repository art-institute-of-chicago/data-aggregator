<?php

namespace App\Mobile;

class Sound extends MobileModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mobile_app_sounds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mobile_id', 'title'];

    public function artworks()
    {

        return $this->belongsToMany('App\Collections\Artwork', 'artwork_mobile_app_sound');

    }

}
