<?php

namespace App\Http\Controllers;

use App\Models\Collections\Category;
use App\Models\Collections\Artwork;
use Illuminate\Http\Request;

class CategoriesController extends ApiNewController
{

    protected $model = \App\Models\Collections\Category::class;

    protected $transformer = \App\Http\Transformers\CategoryTransformer::class;

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

        $all = $artworkId ? Artwork::findOrFail($artworkId)->categories : Category::paginate($limit);
        return response()->collection($all, new $this->transformer);

    }

}
