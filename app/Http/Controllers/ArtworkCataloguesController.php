<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Aic\Hub\Foundation\AbstractController as BaseController;

use App\Models\Collections\Artwork;

class ArtworkCataloguesController extends BaseController
{

    protected $model = \App\Models\Collections\ArtworkCatalogue::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

    // artwork/{id}/artwork-catalogues
    public function forArtwork(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Artwork::findOrFail($id)->artworkCatalogues;

        });

    }

}
