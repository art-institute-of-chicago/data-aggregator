<?php

namespace App\Models\Dsc;

use App\Models\DscModel;

class Footnote extends DscModel
{

    protected $keyType = 'string';

    public function section()
    {

        return $this->belongsTo('App\Models\Dsc\Section');

    }


    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Models\Dsc\Publication  $item
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
