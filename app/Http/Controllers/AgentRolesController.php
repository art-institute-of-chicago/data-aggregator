<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class AgentRolesController extends BaseController
{

    protected $model = \App\Models\Collections\AgentRole::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

}
