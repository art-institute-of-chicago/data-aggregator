<?php

namespace App\Models\Mobile;

use App\Models\MobileModel;

class Artwork extends MobileModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mobile_app_artworks';

    public function artwork()
    {

        return $this->belongsTo('App\Models\Collections\Artwork');

    }

}
