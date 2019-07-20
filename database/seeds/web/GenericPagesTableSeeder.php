<?php

use App\Models\Web\GenericPage;

class GenericPagesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory(GenericPage::class, 25)->create();

    }

}
