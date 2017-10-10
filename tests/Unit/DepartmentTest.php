<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Collections\Department;

class DepartmentTest extends ApiTestCase
{

    protected $model = Department::class;

    protected $route = 'departments';

    protected $keys = ['lake_guid'];

}
