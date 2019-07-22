<?php

namespace App\Models;

class MembershipModel extends BaseModel
{

    protected static $source = 'Membership';

    protected $primaryKey = 'membership_id';

    protected $fakeIdsStartAt = 99900000;

}
