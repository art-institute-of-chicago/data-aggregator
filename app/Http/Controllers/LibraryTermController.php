<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class LibraryTermController extends BaseController
{

    protected $model = \App\Models\Library\Term::class;

    protected $transformer = \App\Http\Transformers\LibraryTermTransformer::class;

}
