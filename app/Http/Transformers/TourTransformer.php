<?php

namespace App\Http\Transformers;

use App\Models\Mobile\Tour;

class TourTransformer extends ApiTransformer
{

    public $excludeDates = true;

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['stops'];


    /**
     * Include stops.
     *
     * @param  \App\Models\Mobile\TourStop  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeStops(Tour $tour)
    {
        return $this->collection($tour->stops, new TourStopTransformer, config('constants.no_data_wrapper'));
    }

}
