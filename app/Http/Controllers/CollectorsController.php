<?php

namespace App\Http\Controllers;

class CollectorsController extends ApiNewController
{

    protected $model = \App\Models\Dsc\Collector::class;

    protected $transformer = \App\Http\Transformers\CollectorTransformer::class;

}
