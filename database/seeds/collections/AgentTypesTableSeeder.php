<?php

use Illuminate\Database\Seeder;

class AgentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Collections\AgentType::class, 25)->create();
    }
}
