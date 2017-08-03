<?php

namespace App\Http\Transformers;

use App\Models\Dsc\Figure;

class FigureTransformer extends DscTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['images', 'vectors'];

    protected $defaultIncludes = ['images', 'vectors'];


    /**
     * Include images.
     *
     * @param  \App\Models\Dsc\Fgiure  $figure
     * @return League\Fractal\ItemResource
     */
    public function includeImages(Figure $figure)
    {
        return $this->collection($figure->images()->getResults(), new FigureImageTransformer, false);
    }

    /**
     * Include vectors.
     *
     * @param  \App\Models\Dsc\Figure  $figure
     * @return League\Fractal\ItemResource
     */
    public function includeVectors(Figure $figure)
    {
        return $this->collection($figure->vectors()->getResults(), new FigureVectorTransformer, false);
    }

}