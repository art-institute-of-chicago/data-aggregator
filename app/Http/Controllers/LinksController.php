<?php

namespace App\Http\Controllers;

class LinksController extends AssetsController
{

    protected $model = \App\Models\Collections\Link::class;

    protected $transformer = \App\Http\Transformers\AssetTransformer::class;

}
