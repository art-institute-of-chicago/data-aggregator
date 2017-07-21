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
     * Turn this item object into a generic array.
     *
     * @param  \App\Models\Dsc\Figure  $item
     * @return array
     */
    public function transformFields($item)
    {
        return [
            'content' => $item->content,
            'section' => $item->section ? $item->section->title : '',
            'section_id' => $item->section_dsc_id,
        ];
    }

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