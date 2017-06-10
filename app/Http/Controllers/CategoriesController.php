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
    public function index($artworkId = null)
    {

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
            if (intval($categoryId) <= 0)
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The category identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
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

}
