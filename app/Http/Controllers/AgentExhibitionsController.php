<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Aic\Hub\Foundation\AbstractController as BaseController;

use App\Models\Collections\Exhibition;

class AgentExhibitionsController extends BaseController
{

    protected $model = \App\Models\Collections\AgentExhibition::class;

    protected $transformer = \App\Http\Transformers\CollectionsTransformer::class;

    // exhibitions/{id}/venues
    public function forExhibition(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Exhibition::findOrFail($id)->venues;

        });

    }

}
