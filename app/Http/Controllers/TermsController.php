<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use Illuminate\Http\Request;

use Aic\Hub\Foundation\AbstractController as BaseController;

class TermsController extends BaseController
{

    protected $model = \App\Models\Collections\Term::class;

    protected $transformer = \App\Http\Transformers\TermTransformer::class;

}
