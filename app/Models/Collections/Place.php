<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

/**
 * A room or hall that works of art are displayed in.
 */
class Place extends CollectionsModel
{
    use ElasticSearchable;

    public static function validateId($id)
    {
        return is_numeric($id);
    }
}
