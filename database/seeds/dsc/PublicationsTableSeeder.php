<?php

use App\Models\Dsc\Publication;

class PublicationsTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {
        factory( Publication::class, 25 )->create();
    }
}
