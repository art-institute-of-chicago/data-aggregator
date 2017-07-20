<?php

namespace App\Http\Controllers;

use App\Models\Dsc\TitlePage;
use Illuminate\Http\Request;

class TitlePagesController extends ApiController
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
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many title pages. Please set a smaller limit.');

        $all = TitlePage::paginate($limit);
        return response()->collection($all, new \App\Http\Transformers\TitlePageTransformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dsc\TitlePage  $dscId
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
                return $this->respondInvalidSyntax('Invalid identifier', "The title page identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = TitlePage::find($dscId);

            if (!$item)
            {
                return $this->respondNotFound('Title page not found', "The title page you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\TitlePageTransformer);
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
        $all = TitlePage::find($ids);
        return response()->collection($all, new \App\Http\Transformers\TitlePageTransformer);

    }

}
