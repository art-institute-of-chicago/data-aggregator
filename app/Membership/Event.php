<?php

namespace App\Membership;

class Event extends MembershipModel
{

    protected $dates = ['start', 'end', 'on_sale', 'off_sale', 'api_created_at', 'api_modified_at', 'api_indexed_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['membership_id', 'title'];
    
}
