<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Collections\ObjectType;

class ObjectTypeTest extends ApiTestCase
{

    protected $model = ObjectType::class;

    protected $route = 'object-types';

    protected $keys = ['lake_guid'];

}
