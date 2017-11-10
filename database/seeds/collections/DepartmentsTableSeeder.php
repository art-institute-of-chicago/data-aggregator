<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\Department;

class DepartmentsTableSeeder extends Seeder
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
