<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use App\Models\Collections\Exhibition;

use Illuminate\Http\Request;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ArtworksController extends BaseController
{

    protected $model = Artwork::class;

    protected $transformer = \App\Http\Transformers\ArtworkTransformer::class;

    // artworks/{id}/sets
    public function sets(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Artwork::findOrFail( $id )->sets()->paginate( $limit );

        });

    }

    // artworks/{id}/parts
    public function parts(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Artwork::findOrFail( $id )->parts()->paginate( $limit );

        });

    }

    // exhibitions/{id}/artworks
    public function forExhibition(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Exhibition::findOrFail($id)->artworks;

        });

    }

}
