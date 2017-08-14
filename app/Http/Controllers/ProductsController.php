<?php

namespace App\Http\Controllers;

use App\Models\Shop\Product;
use Illuminate\Http\Request;

class ProductsController extends ApiController
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
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many products. Please set a smaller limit.');

        $all = Product::paginate($limit);
        return response()->collection($all, new \App\Http\Transformers\ProductTransformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collections\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $productId)
    {

        if ($request->method() != 'GET')
        {

            $this->respondMethodNotAllowed();

        }

        try
        {
            if (intval($productId) <= 0)
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The product identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = Product::find($productId);

            if (!$item)
            {
                return $this->respondNotFound('Product not found', "The product you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\ProductTransformer);
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
        $all = Product::find($ids);
        return response()->collection($all, new \App\Http\Transformers\ProductTransformer);

    }

}
