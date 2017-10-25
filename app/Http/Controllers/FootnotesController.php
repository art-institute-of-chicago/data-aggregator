<?php

namespace App\Http\Controllers;

class FootnotesController extends ApiController
{

    protected $model = \App\Models\Dsc\Footnote::class;

    protected $transformer = \App\Http\Transformers\FootnoteTransformer::class;

    /**
     * Validate `id` route or query string param format.
     * Footnotes follow OSCI `id` format, e.g. `fn-429-158`
     *
     * @param mixed $id
     * @return boolean
     */
    protected function validateId( $id )
    {

        return preg_match( '/^fn-[0-9]+-[0-9]+$/', $id );

    }

}
