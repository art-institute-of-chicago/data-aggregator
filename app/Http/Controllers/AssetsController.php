<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

use Aic\Hub\Foundation\AbstractController as BaseController;

class AssetsController extends BaseController
{

    protected $model = \App\Models\Collections\Asset::class;

    protected $transformer = \App\Http\Transformers\AssetTransformer::class;

    protected function validateId( $id )
    {
        return \App\Models\Collections\Asset::validateId( $id );
    }

    protected function respondInvalidSyntax($message = 'Invalid identifier', $detail = 'The id should be a universally unique identifier. Please ensure you\'re passing the correct source id and try again.')
    {
        return response()->error($message, $detail, Response::HTTP_BAD_REQUEST);
    }

}
