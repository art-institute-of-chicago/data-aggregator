<?php

use Illuminate\Database\Seeder;

class ObjectTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Collections\ObjectType::class, 25)->create();
    }
}
