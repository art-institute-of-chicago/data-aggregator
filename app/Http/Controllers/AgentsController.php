<?php

namespace App\Http\Controllers;

use App\Collections\Agent;
use App\Collections\Artwork;
use Illuminate\Http\Request;

class AgentsController extends ApiController
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

        if ($artworkId)
        {

            if ($request->segment(5) == 'artists')
            {

                $all = Artwork::findOrFail($artworkId)->artists;

            }
            elseif ($request->segment(5) == 'copyrightRepresentatives') {

                $all = Artwork::findOrFail($artworkId)->copyrightRepresentatives;

            }
            else {

                return $this->respondNotFound('Sub-resource not found', "The sub-resource on this artwork you're requesting cannot be found. Please check your URL and try again.");
                
            }

        }
        else
        {

            $all = Agent::whereHas('agentType', function ($query) { $this->whereHas($query); })->paginate($limit);

        }

        return response()->collection($all, new \App\Http\Transformers\AgentTransformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collections\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show($agentId)
    {
        try
        {
            if (intval($agentId) <= 0)
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The agent identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = Agent::whereHas('agentType', function ($query) { $this->whereHas($query); })->find($agentId);

            if (!$item)
            {
                return $this->respondNotFound('Agent not found', "The agent you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\AgentTransformer);
        }
        catch(\Exception $e)
        {
            return $this->respondFailure($e->getMessage());
        }
        
    }

    public function showMutliple($ids = '')
    {

        $ids = explode(',',$ids);
        if (count($ids) > static::LIMIT_MAX)
        {
            
            return $this->respondForbidden('Invalid number of ids', 'You have requested too many ids. Please send a smaller amount.');
            
        }

        $all = Agent::whereHas('agentType', function ($query) { $this->whereHas($query); })->find($ids);
        
        return response()->collection($all, new \App\Http\Transformers\AgentTransformer);
        
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
