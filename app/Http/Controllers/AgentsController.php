<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class AgentsController extends BaseController
{

    protected $model = \App\Models\Collections\Agent::class;

    protected $transformer = \App\Http\Transformers\AgentTransformer::class;

}
