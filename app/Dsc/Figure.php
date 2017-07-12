<?php

namespace App\Dsc;

class Figure extends DscModel
{

    protected $keyType = 'string';

    public function section()
    {

        return $this->belongsTo('App\Dsc\Section');

    }

    public function images()
    {

        return $this->hasMany('App\Dsc\FigureImage');

    }

    public function vectors()
    {

        return $this->hasMany('App\Dsc\FigureVector');

    }

}
