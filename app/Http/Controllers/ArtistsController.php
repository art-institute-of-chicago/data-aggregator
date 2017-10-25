<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use Illuminate\Http\Request;

class ArtistsController extends AgentsController
{

    protected $agentType = 'Artist';

    // artworks/{id}/artists
    public function forArtwork(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Artwork::findOrFail($id)->artists;

        });

    }

}
