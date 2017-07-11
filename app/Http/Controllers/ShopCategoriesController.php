<?php

namespace App\Http\Controllers;

use App\Shop\Category;
use Illuminate\Http\Request;

class ShopCategoriesController extends ApiController
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
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many artworks. Please set a smaller limit.');
        
        $all = Category::paginate($limit);
        return response()->collection($all, new \App\Http\Transformers\ShopCategoryTransformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collections\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $categoryId)
    {

        if ($request->method() != 'GET')
        {

            $this->respondMethodNotAllowed();

        }

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

            return response()->item($item, new \App\Http\Transformers\ShopCategoryTransformer);
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
        return response()->collection($all, new \App\Http\Transformers\ShopCategoryTransformer);
        
    }

}
