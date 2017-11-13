<?php

use App\Models\Dsc\Publication;

class PublicationsTableSeeder extends AbstractSeeder
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
