<?php

namespace App\Membership;

use Illuminate\Database\Eloquent\Model;

class MembershipModel extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'membership_id';
    protected $dates = ['api_created_at', 'api_modified_at'];

}
