<?php

namespace App\Mobile;

class Artwork extends MobileModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mobile_app_artworks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mobile_id', 'title'];

    public function artwork()
    {

        return $this->belongsTo('App\Collections\Artwork');

    }

}
