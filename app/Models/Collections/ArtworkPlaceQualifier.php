<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;

class ArtworkPlaceQualifier extends CollectionsModel
{

    protected $primaryKey = 'citi_id';

    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

}
