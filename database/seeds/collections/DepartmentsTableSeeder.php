<?php

use App\Models\Collections\Department;

class DepartmentsTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Department::class, 25 )->create();
    }
}
