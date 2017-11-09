<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use Illuminate\Http\Request;

class CategoriesController extends ApiController
{

    protected $model = \App\Models\Collections\Category::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;


    // artworks/{id}/categories
    public function forArtwork(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Artwork::findOrFail($id)->categories;

        });

    }

}
