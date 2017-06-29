<?php

namespace App\Http\Transformers;

use App\Mobile\Sound;

class MobileSoundTransformer extends ApiTransformer
{

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Mobile\Tour  $item
     * @return array
     */
    public function transformFields($item)
    {

        return [
            'link' => $item->link,
            'transcript' => $item->transcript,
        ];

    }

}