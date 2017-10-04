<?php

namespace App\Http\Controllers;

class FiguresController extends ApiController
{

    protected $model = \App\Models\Dsc\Figure::class;

    protected $transformer = \App\Http\Transformers\FigureTransformer::class;


    /**
     * Validate `id` route or query string param format.
     * Figures follow OSCI `id` format, e.g. `fig-429-158`
     *
     * @param mixed $id
     * @return boolean
     */
    protected function validateId( $id )
    {

        return preg_match( '/^fig-[0-9]+-[0-9]+$/', $id );

    }

}
