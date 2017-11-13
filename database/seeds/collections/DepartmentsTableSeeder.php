<?php

use App\Models\Collections\Department;

class DepartmentsTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {
        factory( Department::class, 25 )->create();
    }
}
