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
    protected $availableIncludes = ['stops'];

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Models\Mobile\Tour  $item
     * @return array
     */
    public function transformFields($item)
    {

        return [
            'image' => $item->image,
            'description' => $item->description,
            'intro' => $item->intro_text,
            'weight' => $item->weight,
            'intro_link' => $item->intro->link,
            'intro_transcript' => $item->intro->transcript,
        ];

    }

    /**
     * Include stops.
     *
     * @param  \App\Models\Mobile\TourStop  $artwork
     * @return League\Fractal\ItemResource
     */
    public function includeStops(Tour $tour)
    {
        return $this->collection($tour->stops()->getResults(), new TourStopTransformer, config('constants.no_data_wrapper'));
    }

}