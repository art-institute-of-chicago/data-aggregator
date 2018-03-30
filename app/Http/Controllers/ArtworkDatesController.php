<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ArtworkDatesController extends BaseController
{

    protected $model = \App\Models\Collections\ArtworkDate::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

}
