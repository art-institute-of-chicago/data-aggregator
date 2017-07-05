<?php

namespace App\Http\Transformers;

class FootnoteTransformer extends DscTransformer
{

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Dsc\Publication  $item
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