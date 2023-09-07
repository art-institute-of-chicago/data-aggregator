<?php

namespace App\Transformers\Inbound\Collections;

use Illuminate\Database\Eloquent\Model;

use App\Transformers\Inbound\CollectionsTransformer;

class BaseList extends CollectionsTransformer
{
    /**
     * CITI lists have no real lastmod dates.
     * Each item is just a combination of an id and a title.
     * Compare the titles to see if anything changed.
     */
    public function shouldSave(Model $instance, $datum, $isNew = null)
    {
        return $instance->title && $datum->title ? $instance->title !== $datum->title : true;
    }
}
