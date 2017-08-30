<?php

namespace App\Http\Controllers;

class FiguresController extends ApiNewController
{

    protected $model = \App\Models\Dsc\Figure::class;

    protected $transformer = \App\Http\Transformers\FigureTransformer::class;

}
