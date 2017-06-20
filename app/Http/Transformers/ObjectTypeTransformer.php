<?php

namespace App\Http\Transformers;

use App\Collections\ObjectType;
use League\Fractal\TransformerAbstract;

class ObjectTypeTransformer extends ApiTransformer
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