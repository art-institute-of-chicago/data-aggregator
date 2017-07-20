<?php

namespace App\Models\Dsc;

class Figure extends DscModel
{

    protected $keyType = 'string';

    public function section()
    {

        return $this->belongsTo('App\Models\Dsc\Section');

    }

    public function images()
    {

        return $this->hasMany('App\Models\Dsc\FigureImage');

    }

    public function vectors()
    {

        return $this->hasMany('App\Models\Dsc\FigureVector');

    }

}
