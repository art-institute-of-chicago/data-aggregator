<?php

namespace App\Http\Controllers;

use App\Models\Collections\Artwork;
use Illuminate\Http\Request;

class DepartmentsController extends ApiController
{

    protected $model = \App\Models\Collections\Department::class;

    protected $transformer = \App\Http\Transformers\DepartmentTransformer::class;

    // artworks/{id}/department
    // TODO: Is this actually necessary? There's only ever one department per artwork, and there's no extra fields it offers.
    public function forArtwork(Request $request, $id) {

        return $this->collect( $request, function( $limit, $id ) {

            return Artwork::findOrFail($id)->department;

        });

    }
}
