<?php

namespace App\Http\Transformers;

use App\Models\Mobile\TourStop;

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
     * Include mobile sound.
     *
     * @param  \App\Models\Mobile\TourStop  $tourStop
     * @return League\Fractal\ItemResource
     */
    public function includeSound(TourStop $tourStop)
    {
        return $this->item($tourStop->sound, new ApiTransformer, false);
    }

}
