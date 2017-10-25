<?php

namespace App\Http\Controllers;

class ObjectTypesController extends ApiController
{

    protected $model = \App\Models\Collections\ObjectType::class;

    protected $transformer = \App\Http\Transformers\ObjectTypeTransformer::class;

}
