<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use App\Models\Collections\Category;
use Illuminate\Http\Request;

use Aic\Hub\Foundation\AbstractController as BaseController;

class CategoriesController extends BaseController
{

    protected $model = \App\Models\Collections\Category::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;


    // artworks/{id}/categories
    public function forArtwork(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Artwork::findOrFail($id)->categories;

        });

    }

    // departments
    public function departments(Request $request) {

        return $this->collect( $request, function( $limit ) {

            return Category::departments()->paginate($limit);

        });

    }

}
