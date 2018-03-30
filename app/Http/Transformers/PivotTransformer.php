<?php

namespace App\Http\Transformers;

class PivotTransformer extends ApiTransformer
{

    // Pivot models don't need modified dates, ids, or titles
    public $excludeIdsAndTitle = true;
    public $excludeDates = true;

}
