<?php

namespace App\Models;

use App\Models\BaseModel;

class MembershipModel extends BaseModel
{

    protected static $source = 'Membership';

    protected $primaryKey = 'membership_id';

    protected $fakeIdsStartAt = 99900000;

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

}
