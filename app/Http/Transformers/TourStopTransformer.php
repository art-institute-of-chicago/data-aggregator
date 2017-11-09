<?php

namespace App\Http\Transformers;

use App\Models\Mobile\TourStop;
use App\Models\Mobile\Sound;

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

    public function transformFields($item)
    {
        return [];
    }

    /**
     * Include sound.
     *
     * @param  \App\Models\Mobile\Sound  $sound
     * @return League\Fractal\ItemResource
     */
    public function includeSound(TourStop $tourStop)
    {
        return $this->item($tourStop->sound()->getResults(), new ApiTransformer, config('constants.no_data_wrapper'));
    }

}
