<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class ApiNewController extends ApiController
{

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
     * @param  callable $callback
     * @return \Illuminate\Http\Response
     */
    protected function select( Request $request, $callback )
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

        return response()->item($item, new $this->transformer);

    }


    /**
     * Return a list of resources. Not meant to be called directly in routes.
     * `$callback` should return an Eloquent Collection.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  callable $callback
     * @return \Illuminate\Http\Response
     */
    protected function collect( Request $request, $callback )
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

        return response()->collection($all, new $this->transformer);

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

        return response()->collection($all, new $this->transformer);

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


}
