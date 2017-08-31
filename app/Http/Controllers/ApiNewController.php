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
     * @param  \App\Models\Collections\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        // Technically this will never be called, b/c we only bind Route.get
        if ($request->method() != 'GET')
        {
            return $this->respondMethodNotAllowed();
        }

        // Only allow numeric ids
        if (intval($id) <= 0)
        {
            return $this->respondInvalidSyntax();
        }

        // TODO: Improve exception handling via Handler
        $item = ($this->model)::find($id);

        if (!$item)
        {
            return $this->respondNotFound();
        }

        return response()->item($item, new $this->transformer);

    }


    /**
     * Display a listing of the resource.
     *
     * @param null $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        // Assumes the inheriting class set model and transformer
        $all = ($this->model)::paginate($limit);

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

        $ids = explode(',',$ids);

        if (count($ids) > static::LIMIT_MAX)
        {
            return $this->respondTooManyIds();
        }

        $all = ($this->model)::find($ids);

        return response()->collection($all, new $this->transformer);

    }


}
