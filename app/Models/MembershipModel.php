<?php

namespace App\Models;

use App\Models\BaseModel;

class MembershipModel extends BaseModel
{

    protected static $source = 'Membership';

    protected $primaryKey = 'membership_id';

    protected $fakeIdsStartAt = 99900000;

    protected $dates = [
        'start_at',
        'end_at',
    ];

    protected function fillIdsFrom($source)
    {

        $this->membership_id = $source->id;

        return $this;

    }

}
