<?php

namespace App\Http\Controllers;

use App\Models\Membership\Member;
use Illuminate\Http\Request;

class MembersController extends ApiController
{

    protected $model = \App\Models\Membership\Member::class;

    protected $transformer = \App\Http\Transformers\MemberTransformer::class;


    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @param  int $zip
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, $zip)
    {
        if (!$zip)
        {
            return $this->respondInvalidSyntax('Invalid postal code', "The member's postal code must be passed. Please provide the postal code and try again.");
        }

        // We could also call the parent method we're overriding
        return $this->select( $request, function( $id ) {

            return $this->find($id);

        });

    }

    /**
     * Retrieving a list of members is forbidden.
     *
     * @TODO We haven't actually defined this route, but I thought it best to
     * override the inherited method. We should handle the `NotFoundHttpException`
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->respondForbidden();
    }

}
