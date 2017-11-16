<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use Illuminate\Http\Request;

class ImagesController extends AssetsController
{

    protected $model = \App\Models\Collections\Image::class;


    // artworks/{id}/images
    public function forArtwork(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Artwork::findOrFail($id)->images;

        });

    }

}
