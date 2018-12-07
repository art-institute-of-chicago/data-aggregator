<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class LibraryMaterialController extends BaseController
{

    protected $model = \App\Models\Library\Material::class;

    protected $transformer = \App\Http\Transformers\LibraryMaterialTransformer::class;

}
