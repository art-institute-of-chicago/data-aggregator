<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\AgentType;

class AgentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( AgentType::class, 10 )->create();
    }
}
