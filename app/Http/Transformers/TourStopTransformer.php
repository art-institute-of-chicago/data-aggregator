<?php

namespace App\Http\Transformers;

use App\Mobile\TourStop;
use App\Mobile\Sound;

class TourStopTransformer extends ApiTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['sound'];

    /**
     * List of resources to automatically include.
     *
     * @var array
     */
    protected $defaultIncludes = ['sound'];

    public $excludeIdsAndTitle = true;
    public $excludeDates = true;

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Mobile\Tour  $item
     * @return array
     */
    public function transformFields($item)
    {

        return [
            'artwork' => $item->artwork->title,
            'artwork_id' => $item->artwork_citi_id,
            'mobile_sound' => $item->sound->link,
            'mobile_sound_id' => $item->sound_mobile_id,
            'weight' => $item->weight,
            'description' => $item->description,
        ];

    }

    /**
     * Include sound.
     *
     * @param  \App\Mobile\Sound  $sound
     * @return League\Fractal\ItemResource
     */
    public function includeSound(TourStop $tourStop)
    {
        return $this->item($tourStop->sound()->getResults(), new MobileSoundTransformer, config('constants.no_data_wrapper'));
    }

}