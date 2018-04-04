<?php

namespace App\Console\Commands;

use Carbon\Carbon;

class ImportWeb extends ImportWebFull
{

    protected $signature = 'import:web';

    protected $description = "Import web CMS data that has been updated since the last import";


    protected $isPartial = true;


    public function handle()
    {

        $this->importEndpoints();
    }

}
