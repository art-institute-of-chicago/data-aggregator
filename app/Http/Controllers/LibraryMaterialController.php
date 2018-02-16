<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class LibraryMaterialController extends BaseController
{

    protected $model = \App\Models\Library\Material::class;

    protected $transformer = \App\Http\Transformers\LibraryMaterialTransformer::class;

    /**
     * Ensure that the id is a valid Primo doc id.
     *
     * @param string $id
     * @return boolean
     */
    protected function validateId( $id )
    {

        return \App\Models\Library\Material::validateId( $id );

    }

}
