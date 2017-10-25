<?php

namespace App\Http\Controllers;

class SoundsController extends AssetsController
{

    protected $model = \App\Models\Collections\Sound::class;

    protected $transformer = \App\Http\Transformers\SoundTransformer::class;

}
