<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentsController extends ApiNewController
{

    protected $model = \App\Models\Collections\Agent::class;

    protected $transformer = \App\Http\Transformers\AgentTransformer::class;

    protected $agentType = '%';

    protected function paginate($limit )
    {

        return ($this->model)::whereHas('agentType', function ($query) { $this->whereHas($query); })->paginate($limit);

    }

    protected function find( $ids )
    {

        return ($this->model)::whereHas('agentType', function ($query) { $this->whereHas($query); })->find($ids);

    }

    protected function whereHas($query)
    {

        $query->where('title', 'like', $this->agentType);

    }


}
