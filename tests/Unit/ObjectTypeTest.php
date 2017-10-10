<?php

namespace Tests\Unit;

use App\Models\Collections\ObjectType;

class ObjectTypeTest extends ApiTestCase
{

    protected $model = ObjectType::class;

    protected $route = 'object-types';

    protected $keys = ['lake_guid'];

}
