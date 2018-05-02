<?php

namespace App\Http\Transformers;

use App\Models\Mobile\Tour;

class TourTransformer extends ApiTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['tour_stops'];


    /**
     * Include tour stops.
     *
     * @param  \App\Models\Mobile\Tour  $tour
     * @return League\Fractal\ItemResource
     */
    public function includeTourStops(Tour $tour)
    {
        return $this->collection($tour->tourStops, new TourStopTransformer, false);
    }

}
