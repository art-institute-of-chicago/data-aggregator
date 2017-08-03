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
     * @param  \App\Models\Dsc\Figure  $item
     * @return array
     */
    public function transformFields($item)
    {

        return [
            'content' => $item->content,
            'section' => $item->section ? $item->section->title : '',
            'section_id' => $item->section_dsc_id,
        ];

    }

}
