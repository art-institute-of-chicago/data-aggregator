<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\ObjectType;

class ObjectTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( ObjectType::class, 25 )->create();
    }
}
