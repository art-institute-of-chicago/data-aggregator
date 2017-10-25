<?php

namespace App\Http\Controllers;

class TitlePagesController extends ApiController
{

    protected $model = \App\Models\Dsc\TitlePage::class;

    protected $transformer = \App\Http\Transformers\TitlePageTransformer::class;

}
