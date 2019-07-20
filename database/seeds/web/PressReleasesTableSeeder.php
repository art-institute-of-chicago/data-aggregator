<?php

use App\Models\Web\PressRelease;

class PressReleasesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory(PressRelease::class, 25)->create();

    }

}
