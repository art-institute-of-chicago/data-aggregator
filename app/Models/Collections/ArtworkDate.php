<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\ElasticSearchable;

class ArtworkDate extends CollectionsModel
{

    use ElasticSearchable;

    protected $primaryKey = 'citi_id';
    protected $casts = [
        'date_earliest' => 'date',
        'date_latest' => 'date',
    ];

}
