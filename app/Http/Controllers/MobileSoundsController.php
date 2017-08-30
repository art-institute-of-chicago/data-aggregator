<?php

namespace App\Http\Controllers;

class MobileSoundsController extends ApiNewController
{

    protected $model = \App\Models\Mobile\Sound::class;

    protected $transformer = \App\Http\Transformers\MobileSoundTransformer::class;

}
