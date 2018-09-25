<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class EventProgramsController extends BaseController
{

    protected $model = \App\Models\Web\EventProgram::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
