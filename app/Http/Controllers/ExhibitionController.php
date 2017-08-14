<?php

namespace App\Http\Controllers;

use App\Models\Collections\Exhibition;
use Illuminate\Http\Request;

class ExhibitionsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
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
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many exhibitions. Please set a smaller limit.');

        $all = Exhibition::paginate($limit);

        return response()->collection($all, new \App\Http\Transformers\ExhibitionTransformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collections\Exhibition  $exhibition
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $exhibitionId)
    {

        if ($request->method() != 'GET')
        {

            $this->respondMethodNotAllowed();

        }

        try
        {
            if (intval($exhibitionId) <= 0)
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The exhibition identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = Exhibition::find($exhibitionId);

            if (!$item)
            {
                return $this->respondNotFound('Exhibition not found', "The exhibition you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\ExhibitionTransformer);
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
        $all = Exhibition::find($ids);
        return response()->collection($all, new \App\Http\Transformers\ExhibitionTransformer);

    }

}
