<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use App\Models\Collections\Exhibition;
use Illuminate\Http\Request;

class AgentsController extends ApiController
{

    protected $model = \App\Models\Collections\Agent::class;

    protected $transformer = \App\Http\Transformers\AgentTransformer::class;

    /**
     * Display a listing of the resource.
     *
     * @param null $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
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

        if ($id)
        {

            if ($request->segment(5) == 'artists')
            {

                $all = Artwork::findOrFail($id)->artists;

            }
            elseif ($request->segment(5) == 'copyrightRepresentatives') {

                $all = Artwork::findOrFail($id)->copyrightRepresentatives;

            }
            elseif ($request->segment(5) == 'venues') {

                $all = Exhibition::findOrFail($id)->venues;

            }
            else {

                return $this->respondNotFound('Sub-resource not found', "The sub-resource on this artwork you're requesting cannot be found. Please check your URL and try again.");

            }

        }
        else
        {

            $all = ($this->model)::whereHas('agentType', function ($query) { $this->whereHas($query); })->paginate($limit);

        }

        return response()->collection($all, new $this->transformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collections\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $agentId)
    {

        if ($request->method() != 'GET')
        {

            $this->respondMethodNotAllowed();

        }

        try
        {
            if (intval($agentId) <= 0)
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The agent identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = ($this->model)::whereHas('agentType', function ($query) { $this->whereHas($query); })->find($agentId);

            if (!$item)
            {
                return $this->respondNotFound('Agent not found', "The agent you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new $this->transformer);
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

        $all = ($this->model)::whereHas('agentType', function ($query) { $this->whereHas($query); })->find($ids);

        return response()->collection($all, new $this->transformer);

    }

    protected function agentTypeFilter()
    {

        return '%';

    }

    protected function whereHas($query)
    {

        $query->where('title', 'like', $this->agentTypeFilter());

    }
}
