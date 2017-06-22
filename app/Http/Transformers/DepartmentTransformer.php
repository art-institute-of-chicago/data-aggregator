<?php

namespace App\Http\Transformers;

use App\Collections\Department;

class DepartmentTransformer extends CollectionsTransformer
{

    public $citiObject = true;

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Department  $item
     * @return array
     */
    public function transformFields($item)
    {
        return [
        ];
    }
}