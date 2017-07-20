<?php

namespace App\Models;

use App\Models\BaseModel;

class MembershipModel extends BaseModel
{

    protected $primaryKey = 'membership_id';
    protected $dates = ['source_created_at', 'source_modified_at'];

}
