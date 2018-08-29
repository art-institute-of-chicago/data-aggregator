<?php

namespace App\Http\Controllers;

use App\Models\Collections\Exhibition;

use Illuminate\Http\Request;

use Aic\Hub\Foundation\AbstractController as BaseController;

class AgentExhibitionsController extends BaseController
{

    protected $model = \App\Models\Collections\AgentExhibition::class;

    protected $transformer = \App\Http\Transformers\PivotTransformer::class;

    // exhibitions/{id}/venues
    public function forExhibition(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Exhibition::findOrFail($id)->venuePivots;

        });

    }

}
