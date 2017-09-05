<?php

namespace App\Http\Controllers;

class FootnotesController extends ApiController
{

    protected $model = \App\Models\Dsc\Footnote::class;

    protected $transformer = \App\Http\Transformers\FootnoteTransformer::class;

}
