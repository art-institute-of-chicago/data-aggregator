<?php

namespace App\Http\Controllers;

class PublicationsController extends ApiController
{

    protected $model = \App\Models\Dsc\Publication::class;

    protected $transformer = \App\Http\Transformers\PublicationTransformer::class;

}
