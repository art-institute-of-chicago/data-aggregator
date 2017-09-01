<?php

namespace App\Http\Controllers;

class ObjectTypesController extends ApiNewController
{

    protected $model = \App\Models\Collections\ObjectType::class;

    protected $transformer = \App\Http\Transformers\ObjectTypeTransformer::class;

}
