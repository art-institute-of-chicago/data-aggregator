<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

class ArtworkDate extends CollectionsModel
{

    use ElasticSearchable;

    protected $primaryKey = 'citi_id';
    protected $dates = ['date_earliest', 'date_latest', 'source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];

}
