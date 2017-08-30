<?php

namespace App\Http\Controllers;

class ExhibitionsController extends ApiNewController
{

    protected $model = \App\Models\Collections\Exhibition::class;

    protected $transformer = \App\Http\Transformers\ExhibitionTransformer::class;

}
