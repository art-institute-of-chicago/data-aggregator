<?php

namespace App\Dsc;

class Figure extends DscModel
{

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dsc_id', 'title'];

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
