<?php

namespace App\Http\Controllers;

use App\Collections\AgentType;
use App\Collections\Agent;
use Illuminate\Http\Request;

class AgentTypesController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param null $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $ids = $request->input('ids');
        if ($ids)
        {

            return $this->showMutliple($ids);

        }

        $limit = $request->input('limit') ?: 12;
        if ($limit > static::LIMIT_MAX) return $this->respondForbidden('Invalid limit', 'You have requested too many agent types. Please set a smaller limit.');

        $all = AgentType::paginate();
        return response()->collection($all, new \App\Http\Transformers\AgentTypeTransformer);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collections\AgentType  $agentType
     * @return \Illuminate\Http\Response
     */
    public function show($agentTypeId)
    {
        try
        {
            if (intval($agentTypeId) <= 0)
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The agent type identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
            }

            $item = AgentType::find($agentTypeId);

            if (!$item)
            {
                return $this->respondNotFound('Agent Type not found', "The agent type you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\AgentTypeTransformer);
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
        $all = AgentType::find($ids);
        return response()->collection($all, new \App\Http\Transformers\AgentTypeTransformer);
        
    }

}
