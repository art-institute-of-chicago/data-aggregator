<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use Illuminate\Http\Request;

class CopyrightRepresentativesController extends AgentsController
{

    // TODO: Changed this route from camel case and update Swagger docs
    // artworks/{id}/copyrightRepresentatives
    public function forArtwork(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Artwork::findOrFail($id)->copyrightRepresentatives;

        });

    }

}
