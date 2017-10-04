<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

abstract class AssetsController extends ApiController
{

    protected function validateId( $id )
    {
        return $this->isUuid( $id );
    }

    protected function respondInvalidSyntax($message = 'Invalid identifier', $detail = 'The id should be a universally unique identifier. Please ensure you\'re passing the correct source id and try again.')
    {
        return response()->error($message, $detail, Response::HTTP_BAD_REQUEST);
    }

}
