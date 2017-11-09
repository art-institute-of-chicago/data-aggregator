<?php

namespace App\Http\Transformers;

use App\Models\Collections\Department;

class DepartmentTransformer extends CollectionsTransformer
{

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Department  $item
     * @return array
     */
    public function transformFields($item)
    {
        return [];
    }

}
