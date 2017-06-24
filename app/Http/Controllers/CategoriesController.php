<?php

namespace App\Http\Controllers;

use App\Collections\Category;
use App\Collections\Artwork;
use Illuminate\Http\Request;

class CategoriesController extends ApiController
{

    /**
     * Display a listing of the resource.
     *
     * @param null $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $artworkId = null)
    {

        $ids = $request->input('ids');
        if ($ids)
        {

            return $this->showMutliple($ids);

        }

        $limit = $request->input('limit') ?: 12;
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many artworks. Please set a smaller limit.');
        
        $all = $artworkId ? Artwork::findOrFail($artworkId)->categories : Category::paginate();
        return response()->collection($all, new \App\Http\Transformers\CategoryTransformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collections\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($categoryId)
    {
        try
        {

            if (!$this->isUuid($categoryId))
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The category identifier should be a universally unique identifier. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = Category::find($categoryId);

            if (!$item)
            {
                return $this->respondNotFound('Category not found', "The category you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\CategoryTransformer);
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
        $all = Category::find($ids);
        return response()->collection($all, new \App\Http\Transformers\CategoryTransformer);
        
    }

}
