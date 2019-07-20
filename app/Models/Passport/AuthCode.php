<?php

namespace App\Models\Passport;

use Laravel\Passport\AuthCode as BaseAuthCode;

class AuthCode extends BaseAuthCode {

    protected $connection = 'userdata';

}
