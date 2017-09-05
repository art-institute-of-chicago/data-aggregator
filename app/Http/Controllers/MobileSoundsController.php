<?php

namespace App\Http\Controllers;

class MobileSoundsController extends ApiController
{

    protected $model = \App\Models\Mobile\Sound::class;

    protected $transformer = \App\Http\Transformers\MobileSoundTransformer::class;

}
