<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class AgentTypesController extends BaseController
{

    protected $model = \App\Models\Collections\AgentType::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

}
