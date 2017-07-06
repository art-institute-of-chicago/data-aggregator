<?php

namespace App\Dsc;

class WorkOfArt extends DscModel
{

    public $table = 'works_of_art';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dsc_id', 'title'];

    public function publication()
    {

        return $this->belongsTo('App\Dsc\Publication');

    }

    public function artwork()
    {

        return $this->belongsTo('App\Collections\Artwork');

    }

}
