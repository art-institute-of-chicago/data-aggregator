<?php

namespace App\Http\Controllers;

use App\Dsc\WorkOfArt;
use Illuminate\Http\Request;

class WorksOfArtController extends ApiController
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
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many works of art. Please set a smaller limit.');

        $all = WorkOfArt::paginate($limit);
        return response()->collection($all, new \App\Http\Transformers\WorkOfArtTransformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dsc\WorkOfArt  $dscId
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
            if (intval($dscId) <= 0)
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The work of art identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = WorkOfArt::find($dscId);

            if (!$item)
            {
                return $this->respondNotFound('Work of art not found', "The work of art you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\WorkOfArtTransformer);
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
        $all = WorkOfArt::find($ids);
        return response()->collection($all, new \App\Http\Transformers\WorkOfArtTransformer);
        
    }

}
