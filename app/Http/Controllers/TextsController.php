<?php

namespace App\Http\Controllers;

class TextsController extends AssetsController
{

    protected $model = \App\Models\Collections\Text::class;

    protected $transformer = \App\Http\Transformers\AssetTransformer::class;

}
