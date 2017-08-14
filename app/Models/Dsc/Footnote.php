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
