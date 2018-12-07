<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class AgentRolesController extends BaseController
{

    protected $model = \App\Models\Collections\AgentRole::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

}
