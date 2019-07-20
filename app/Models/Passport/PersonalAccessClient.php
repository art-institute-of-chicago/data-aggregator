<?php

namespace App\Models\Passport;

use Laravel\Passport\PersonalAccessClient as BasePersonalAccessClient;

class PersonalAccessClient extends BasePersonalAccessClient {

    protected $connection = 'userdata';

}
