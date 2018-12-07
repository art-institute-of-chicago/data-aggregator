<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class EventProgramsController extends BaseController
{

    protected $model = \App\Models\Web\EventProgram::class;

    protected $transformer = \App\Http\Transformers\ApiTransformer::class;

}
