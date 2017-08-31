<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

abstract class ApiController extends Controller
{

    const LIMIT_MAX = 1000;


    protected function isUuid($id)
    {

        // We must not be using UUIDv3, since the typical regex wasn't matching
        $uuid = '/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/i';

        return preg_match($uuid, $id);

    }

    // TODO: Currently unused?
    protected function isDscId($id)
    {

        $dscFormat = '/^[a-z]{2,3}-[0-9]+-[0-9]+$/i';

        return preg_match($dscFormat, $id);

    }

    // See boot() in App\Providers\AppServiceProvider for the error() macro
    // TODO: Move these into Exceptions?

    protected function respondNotFound($message = 'Not found', $detail = 'The item you requested cannot be found.')
    {
        return response()->error($message, $detail, Response::HTTP_NOT_FOUND);
    }

    protected function respondInvalidSyntax($message = 'Invalid syntax', $detail = 'The identifier is invalid.')
    {
        return response()->error($message, $detail, Response::HTTP_BAD_REQUEST);
    }

    protected function respondFailure($message = 'Failed request', $detail = 'The request failed.')
    {
        return response()->error($message, $detail, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    protected function respondForbidden($message = 'Forbidden', $detail = 'This request is forbidden.')
    {
        return response()->error($message, $detail, Response::HTTP_FORBIDDEN);
    }

    protected function respondTooManyIds($message = 'Invalid number of ids', $detail = 'You have requested too many ids. Please send a smaller amount.')
    {
        return response()->error($message, $detail, Response::HTTP_FORBIDDEN);
    }

    protected function respondBigLimit($message = 'Invalid limit', $detail = 'You have requested too many resources. Please set a smaller limit.')
    {
        return $this->error($message, $detail, Response::HTTP_FORBIDDEN);
    }

    protected function respondMethodNotAllowed($message = 'Method not allowed', $detail = 'Method not allowed.')
    {
        return response()->error($message, $detail, Response::HTTP_METHOD_NOT_ALLOWED);
    }

}
