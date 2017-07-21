<?php

namespace App\Models\Membership;

use App\Models\MembershipModel;

class Event extends MembershipModel
{

    protected $dates = ['start', 'end', 'on_sale', 'off_sale', 'source_created_at', 'source_modified_at', 'source_indexed_at'];

}
