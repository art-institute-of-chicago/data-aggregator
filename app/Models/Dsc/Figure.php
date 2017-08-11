<?php

namespace App\Models\Dsc;

use App\Models\DscModel;

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


    /**
     * Turn this item object into a generic array.
     *
     * @return array
     */
    public function transformFields()
    {

        return [
            'content' => $this->content,
            'section' => $this->section ? $this->section->title : '',
            'section_id' => $this->section_dsc_id,
        ];

    }

}
