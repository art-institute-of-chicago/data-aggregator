<?php

namespace App\Http\Controllers;

class AgentTypesController extends ApiController
{

    protected $model = \App\Models\Collections\AgentType::class;

    protected $transformer = \App\Http\Transformers\AgentTypeTransformer::class;

}
