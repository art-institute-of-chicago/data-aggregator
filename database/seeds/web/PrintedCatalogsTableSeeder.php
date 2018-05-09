<?php

use App\Models\Web\PrintedCatalog;

class PrintedCatalogsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( PrintedCatalog::class, 25 )->create();

    }

}
