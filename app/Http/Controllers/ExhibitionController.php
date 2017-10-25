<?php

namespace App\Http\Controllers;

class ExhibitionsController extends ApiController
{

    protected $model = \App\Models\Collections\Exhibition::class;

    protected $transformer = \App\Http\Transformers\ExhibitionTransformer::class;

}
