<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Collections\Agent;
use App\Models\Collections\Artwork;

use Aic\Hub\Foundation\AbstractController as BaseController;

class AgentsController extends BaseController
{

    protected $model = \App\Models\Collections\Agent::class;

    protected $transformer = \App\Http\Transformers\AgentTransformer::class;

    // artworks/{id}/artists
    public function scopeForArtwork(Request $request, $id) {

        // Technically, this is a relation, not a scope. Better naming?
        $scope = camel_case( array_slice( $request->segments(), -1, 1 )[0] );

        return $this->collect( $request, function( $limit, $id ) use ( $scope ) {

            return Artwork::findOrFail($id)->$scope;

        });

    }

}
