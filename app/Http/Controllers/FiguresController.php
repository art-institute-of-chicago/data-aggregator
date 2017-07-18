<?php

namespace App\Http\Controllers;

use App\Dsc\Figure;
use Illuminate\Http\Request;

class FiguresController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param null $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->method() != 'GET')
        {

            $this->respondMethodNotAllowed();

        }

        $ids = $request->input('ids');
        if ($ids)
        {

            return $this->showMutliple($ids);

        }

        $limit = $request->input('limit') ?: 12;
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many figures. Please set a smaller limit.');

        $all = Figure::paginate($limit);
        return response()->collection($all, new \App\Http\Transformers\FigureTransformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dsc\Figure  $dscId
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $dscId)
    {

        if ($request->method() != 'GET')
        {

            $this->respondMethodNotAllowed();

        }

        try
        {
            if (!$this->isDscId($dscId))
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The figure identifier is in an invalid format. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = Figure::find($dscId);

            if (!$item)
            {
                return $this->respondNotFound('Figure not found', "The figure you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\FigureTransformer);
        }
        catch(\Exception $e)
        {
            return $this->respondFailure();
        }

    }

    public function showMutliple($ids = '')
    {

        $ids = explode(',',$ids);
        if (count($ids) > static::LIMIT_MAX)
        {

            return $this->respondForbidden('Invalid number of ids', 'You have requested too many ids. Please send a smaller amount.');

        }
        $all = Figure::find($ids);
        return response()->collection($all, new \App\Http\Transformers\FigureTransformer);

    }

}
