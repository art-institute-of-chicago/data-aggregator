<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

/**
 * A gender associated with an agent.
 */
class Gender extends CollectionsModel
{
    use ElasticSearchable;

    protected $primaryKey = 'citi_id';

    public static function validateId($id)
    {
        return is_numeric($id);
    }
}
