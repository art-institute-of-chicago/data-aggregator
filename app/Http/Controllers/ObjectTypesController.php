<?php

namespace App\Http\Controllers;

use App\Models\Collections\ObjectType;
use App\Models\Collections\Artwork;
use Illuminate\Http\Request;

class ObjectTypesController extends ApiNewController
{

    protected $model = \App\Models\Collections\ObjectType::class;

    protected $transformer = \App\Http\Transformers\ObjectTypeTransformer::class;

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
            return response()->item(Artwork::findOrFail($artworkId)->objectType, new $this->transformer);
        }
        else
        {
            $all = ObjectType::paginate($limit);
            return response()->collection($all, new $this->transformer);
        }

    }

}
