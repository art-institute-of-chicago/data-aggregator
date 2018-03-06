<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use Illuminate\Http\Request;

use Aic\Hub\Foundation\AbstractController as BaseController;

class TermsController extends BaseController
{

    protected $model = \App\Models\Collections\Term::class;

    protected $transformer = \App\Http\Transformers\TermTransformer::class;

    protected function validateId( $id )
    {
        return \App\Models\Collections\Term::validateId( $id );
    }


    // artworks/{id}/terms
    public function forArtwork(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Artwork::findOrFail($id)->terms;

        });

    }

}
