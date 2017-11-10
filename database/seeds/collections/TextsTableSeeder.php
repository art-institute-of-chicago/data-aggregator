<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\Text;

class TextsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Text::class, 25 )->create();
    }
}
