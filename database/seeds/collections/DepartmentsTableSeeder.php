<?php

use App\Models\Collections\Department;

class DepartmentsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory( Department::class, 25 )->create();
    }

}
