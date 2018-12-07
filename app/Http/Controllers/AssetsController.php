<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as BaseController;

class AssetsController extends BaseController
{

    protected $model = \App\Models\Collections\Asset::class;

    protected $transformer = \App\Http\Transformers\AssetTransformer::class;

}
