<?php

namespace App\Http\Transformers;

use App\Collections\Department;
use League\Fractal\TransformerAbstract;

class DepartmentTransformer extends ApiTransformer
{

    public $citiObject = true;

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Department  $item
     * @return array
     */
    public function transformFields(Department $item)
    {
        return [
        ];
    }
}