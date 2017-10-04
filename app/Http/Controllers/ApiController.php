<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Closure;

abstract class ApiController extends Controller
{

    const LIMIT_MAX = 1000;

    protected $model;

    protected $transformer;

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        return $this->select( $request, function( $id ) {

            return $this->find($id);

        });

    }


    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return $this->collect( $request, function( $limit ) {

            return $this->paginate( $limit );

        });

    }


    /**
     * Call to find specific id(s). Override this method when logic to get
     * a model is more complex than a simple `$model::find($id)` call.
     *
     * @param mixed $ids
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function find($ids)
    {

        return ($this->model)::instance()->find($ids);

    }


    /**
     * Call to get a model list. Override this method when logic to get
     * models is more complex than a simple `$model::paginate($limit)` call.
     *
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function paginate($limit)
    {

        return ($this->model)::paginate($limit);

    }


    /**
     * Return a single resource. Not meant to be called directly in routes.
     * `$callback` should return an Eloquent Model.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $callback
     * @return \Illuminate\Http\Response
     */
    protected function select( Request $request, Closure $callback )
    {

        // Technically this will never be called, b/c we only bind Route.get
        if ($request->method() != 'GET')
        {
            return $this->respondMethodNotAllowed();
        }

        $id = $request->route('id');

        if (!$this->validateId( $id ))
        {
            return $this->respondInvalidSyntax();
        }

        // TODO: Improve exception handling via Handler
        $item = $callback( $id );

        if (!$item)
        {
            return $this->respondNotFound();
        }

        $fields = Input::get('fields');

        return response()->item($item, new $this->transformer($fields) );

    }


    /**
     * Return a list of resources. Not meant to be called directly in routes.
     * `$callback` should return an Eloquent Collection.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $callback
     * @return \Illuminate\Http\Response
     */
    protected function collect( Request $request, Closure $callback )
    {

        // Technically this will never be called, b/c we only bind Route.get
        if ($request->method() != 'GET')
        {
            return $this->respondMethodNotAllowed();
        }

        // Process ?ids= query param
        $ids = $request->input('ids');

        if ($ids)
        {
            return $this->showMutliple($ids);
        }

        // Check if the ?limit= is too big
        $limit = $request->input('limit') ?: 12;

        if ($limit > static::LIMIT_MAX)
        {
            return $this->respondBigLimit();
        }

        // This would happen for subresources
        $id = $request->route('id');

        // Assumes the inheriting class set model and transformer
        $all = $callback( $limit, $id );

        $fields = Input::get('fields');

        return response()->collection($all, new $this->transformer($fields) );

    }


    /**
     * Display multiple resources.
     *
     * @param string $ids
     * @return \Illuminate\Http\Response
     */
    protected function showMutliple($ids = '')
    {

        $ids = explode(',', $ids);

        if (count($ids) > static::LIMIT_MAX)
        {
            return $this->respondTooManyIds();
        }

        // Validate the syntax for each $id
        foreach( $ids as $id )
        {

            if (!$this->validateId( $id ))
            {
                return $this->respondInvalidSyntax();
            }

        }

        $all = $this->find($ids);

        $fields = Input::get('fields');

        return response()->collection($all, new $this->transformer($fields) );

    }


    /**
     * Validate `id` route or query string param format. By default, only
     * numeric ids greater than zero are accepted. Override this method in
     * child classes to implement different validation rules (e.g. UUID).
     *
     * @TODO Move this logic to the base model classes?
     *
     * @param mixed $id
     * @return boolean
     */
    protected function validateId( $id )
    {

        // By default, only allow numeric ids greater than 0
        return intval($id) > 0;

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


    /**
     * Helper function for validating ids from the OSCI Toolkit.
     *
     * @param mixed $id
     * @return boolean
     */
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
        return response()->error($message, $detail, Response::HTTP_FORBIDDEN);
    }

    protected function respondMethodNotAllowed($message = 'Method not allowed', $detail = 'Method not allowed.')
    {
        return response()->error($message, $detail, Response::HTTP_METHOD_NOT_ALLOWED);
    }

}
