<?php

use Illuminate\Database\Seeder;

use App\Models\Dsc\Publication;

class PublicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( Publication::class, 25 )->create();
    }
}
