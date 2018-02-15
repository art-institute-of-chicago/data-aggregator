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
    protected $availableIncludes = ['tour_stops'];


    /**
     * Include tour stops.
     *
     * @param  \App\Models\Mobile\TourStop  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeTourStops(Tour $tour)
    {
        return $this->collection($tour->tourStops, new TourStopTransformer, config('constants.no_data_wrapper'));
    }

}
