<?php

namespace App\Http\Transformers;

use App\Models\Collections\Asset;

class AssetTransformer extends CollectionsTransformer
{

    /**
     * Assets are native to LAKE, not CITI.
     *
     * @var boolean
     */
    public $citiObject = false;

}
