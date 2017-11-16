<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use Illuminate\Http\Request;

class ArtistsController extends AgentsController
{

    // artworks/{id}/artists
    public function forArtwork(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Artwork::findOrFail($id)->artists;

        });

    }

    protected function paginate($limit )
    {

        return ($this->model)::where('is_artist', '=', TRUE)->paginate($limit);

    }

    protected function find( $ids )
    {

        return ($this->model)::where('is_artist', '=', TRUE)->find($ids);

    }

}
