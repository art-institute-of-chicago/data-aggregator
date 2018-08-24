<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;

use Illuminate\Http\Request;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ArtworkCataloguesController extends BaseController
{

    protected $model = \App\Models\Collections\ArtworkCatalogue::class;

    protected $transformer = \App\Http\Transformers\PivotTransformer::class;

    // artwork/{id}/artwork-catalogues
    public function forArtwork(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Artwork::findOrFail($id)->artworkCatalogues;

        });

    }

}
