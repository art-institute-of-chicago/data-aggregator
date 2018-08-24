<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class TermsController extends BaseController
{

    protected $model = \App\Models\Collections\Term::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

}
