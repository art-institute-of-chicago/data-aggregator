<?php

namespace App\Http\Controllers;

use App\Collections\ObjectType;
use App\Collections\Artwork;
use Illuminate\Http\Request;

class ObjectTypesController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param null $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $artworkId = null)
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
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many artworks. Please set a smaller limit.');

        if ($artworkId)
        {
            return response()->item(Artwork::findOrFail($artworkId)->objectType, new \App\Http\Transformers\ObjectTypeTransformer);
        }
        else
        {
            $all = ObjectType::paginate();
            return response()->collection($all, new \App\Http\Transformers\ObjectTypeTransformer);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collections\ObjectType  $objectType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $objectTypeId)
    {

        if ($request->method() != 'GET')
        {

            $this->respondMethodNotAllowed();

        }

        try
        {
            if (intval($objectTypeId) <= 0)
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The objectType identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = ObjectType::find($objectTypeId);

            if (!$item)
            {
                return $this->respondNotFound('ObjectType not found', "The objectType you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\ObjectTypeTransformer);
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
        $all = ObjectType::find($ids);
        return response()->collection($all, new \App\Http\Transformers\ObjectTypeTransformer);
        
    }

}
