<?php

namespace App\Http\Controllers;

class WorksOfArtController extends ApiNewController
{

    protected $model = \App\Models\Dsc\WorkOfArt::class;

    protected $transformer = \App\Http\Transformers\WorkOfArtTransformer::class;

}
