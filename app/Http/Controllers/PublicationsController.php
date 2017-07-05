<?php

namespace App\Http\Controllers;

use App\Dsc\Publication;
use Illuminate\Http\Request;

class PublicationsController extends ApiController
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
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many publications. Please set a smaller limit.');

        $all = Publication::paginate();
        return response()->collection($all, new \App\Http\Transformers\PublicationTransformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dsc\Publication  $dscId
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
                return $this->respondInvalidSyntax('Invalid identifier', "The publication identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = Publication::find($dscId);

            if (!$item)
            {
                return $this->respondNotFound('Publication not found', "The publication you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\PublicationTransformer);
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
        $all = Publication::find($ids);
        return response()->collection($all, new \App\Http\Transformers\PublicationTransformer);
        
    }

}
