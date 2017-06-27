<?php

namespace App\Http\Transformers;

use App\Membership\Member;

class MemberTransformer extends ApiTransformer
{

    public $excludeDates = true;

    /**
     * Turn this item object into a generic array.
     *
     * @param  \App\Membership\Member  $item
     * @return array
     */
    public function transformFields($item)
    {

        return [
            'first_name' => $item->first_name,
            'last_name' => $item->last_name,
            'street_1' => $item->street_1,
            'street_2' => $item->street_2,
            'city' => $item->city,
            'state' => $item->state,
            'zip' => $item->zip,
            'email' => $item->email,
            'phone' => $item->phone,
            'membership_level' => $item->membership_level,
            'opened' => $item->opened_at->toDateTimeString(),
            'used' => $item->used_at->toDateTimeString(),
            'expires' => $item->expires_at->toDateTimeString(),
        ];

    }

}