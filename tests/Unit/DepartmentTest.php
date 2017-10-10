<?php

namespace Tests\Unit;

use App\Models\Collections\Department;

class DepartmentTest extends ApiTestCase
{

    protected $model = Department::class;

    protected $route = 'departments';

    protected $keys = ['lake_guid'];

}
