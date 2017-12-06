<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Collections\Artwork;
use App\Models\Collections\Exhibition;

class AgentsController extends ApiController
{

    protected $model = \App\Models\Collections\Agent::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

    // artworks/{id}/artists
    // artworks/{id}/copyrightRepresentatives
    // TODO: Change this route from camel case and update Swagger docs
    public function scopeForArtwork(Request $request, $id) {

        // Technically, this is a relation, not a scope. Better naming?
        $scope = camel_case( array_slice( $request->segments(), -1, 1 )[0] );

        return $this->collect( $request, function( $limit, $id ) use ( $scope ) {

            return Artwork::findOrFail($id)->$scope;

        });

    }

    // exhibitions/{id}/venues
    public function forExhibition(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Exhibition::findOrFail($id)->venues;

        });

    }

}
