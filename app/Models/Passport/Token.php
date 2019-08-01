<?php

namespace App\Models\Passport;

use Laravel\Passport\Token as BaseToken;

class Token extends BaseToken
{

    protected $connection = 'userdata';

}
