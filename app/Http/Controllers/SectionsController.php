<?php

namespace App\Http\Controllers;

class SectionsController extends ApiController
{

    protected $model = \App\Models\Dsc\Section::class;

    protected $transformer = \App\Http\Transformers\SectionTransformer::class;

}
