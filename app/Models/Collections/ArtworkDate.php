<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;

class ArtworkDate extends CollectionsModel
{

    public $incrementing = true;

    protected $dates = ['date', 'source_created_at', 'source_modified_at', 'source_indexed_at'];

}
