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
        return $this->isUuid( $id );
    }

    protected function respondInvalidSyntax($message = 'Invalid identifier', $detail = 'The id should be a universally unique identifier. Please ensure you\'re passing the correct source id and try again.')
    {
        return response()->error($message, $detail, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Helper function for validating our UUIDs.
     *
     * @param mixed $id
     * @return boolean
     */
    protected function isUuid($id)
    {

        // We must not be using UUIDv3, since the typical regex wasn't matching
        $uuid = '/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/i';

        return preg_match($uuid, $id);

    }

}
