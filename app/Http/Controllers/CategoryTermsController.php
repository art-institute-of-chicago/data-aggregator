<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use App\Models\Collections\Category;
use Illuminate\Http\Request;

use Aic\Hub\Foundation\AbstractController as BaseController;

class CategoryTermsController extends BaseController
{

    protected $model = \App\Models\Collections\CategoryTerm::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

    protected function validateId( $id )
    {
        return \App\Models\Collections\Term::validateId( $id );
    }

}
