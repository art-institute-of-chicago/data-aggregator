<?php

namespace App\Http\Controllers;

use App\Membership\Member;
use Illuminate\Http\Request;

class MembersController extends ApiController
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Collections\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $memberId, $zip)
    {

        if ($request->method() != 'GET')
        {

            $this->respondMethodNotAllowed();

        }

        try
        {
            if (intval($memberId) <= 0)
            {
                return $this->respondInvalidSyntax('Invalid identifier', "The member identifier should be a number. Please ensure you're passing the correct source identifier and try again.");
            }

            if (!$zip)
            {
                return $this->respondInvalidSyntax('Invalid postal code', "The member's postal code must be passed. Please provide the postal code and try again.");
            }

            $item = Member::find($memberId);

            if (!$item)
            {
                return $this->respondNotFound('Member not found', "The member you requested cannot be found. Please ensure you're passing the source identifier and try again.");
            }

            return response()->item($item, new \App\Http\Transformers\MemberTransformer);
        }
        catch(\Exception $e)
        {
            return $this->respondFailure($e->getMessage());
        }

    }

}
