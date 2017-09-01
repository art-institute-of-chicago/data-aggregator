<?php

namespace App\Http\Controllers;

use App\Models\Collections\Exhibition;
use Illuminate\Http\Request;

class VenuesController extends AgentsController
{

    protected $agentType = 'Corporate Body';

    // exhibitions/{id}/venues
    public function forExhibition(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Exhibition::findOrFail($id)->venues;

        });

    }

}
