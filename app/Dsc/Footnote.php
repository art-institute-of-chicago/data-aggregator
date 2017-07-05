<?php

namespace App\Dsc;

class Footnote extends DscModel
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

}
