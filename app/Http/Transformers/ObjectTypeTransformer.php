<?php

namespace App\Http\Transformers;

use App\Models\Collections\ObjectType;

class ObjectTypeTransformer extends CollectionsTransformer
{

    public $citiObject = true;

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\ObjectType  $item
     * @return array
     */
    public function transformFields($item)
    {
        return [
        ];
    }

}
