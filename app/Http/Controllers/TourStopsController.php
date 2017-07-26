<?php

namespace App\Http\Controllers;

use App\Models\Mobile\TourStop;
use Illuminate\Http\Request;

class TourStopsController extends ApiController
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
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many tour stops. Please set a smaller limit.');

        $all = TourStop::paginate($limit);
        return response()->collection($all, new \App\Http\Transformers\TourStopTransformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mobile\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        if ($request->method() != 'GET')
        {

            $this->respondMethodNotAllowed();

        }

        try
        {
            if (intval($id) <= 0)
            {
                return $this->respondInvalidSyntax();
            }

            $item = TourStop::find($id);

            if (!$item)
            {
                return $this->respondNotFound();
            }

            return response()->item($item, new \App\Http\Transformers\TourStopTransformer);
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

            return $this->respondTooManyIds();

        }
        $all = TourStop::find($ids);
        return response()->collection($all, new \App\Http\Transformers\TourStopTransformer);

    }

}
