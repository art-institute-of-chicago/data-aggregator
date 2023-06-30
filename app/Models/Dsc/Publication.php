<?php

namespace App\Models\Dsc;

use App\Models\DscModel;
use App\Models\ElasticSearchable;

/**
 * Represents an overall digital publication.
 */
class Publication extends DscModel
{
    use ElasticSearchable;

    public function sections()
    {
        return $this->hasMany('App\Models\Dsc\Section');
    }
}
