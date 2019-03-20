<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\DB;

class DumpAudit extends AbstractDumpCommand
{

    protected $signature = 'dump:audit';

    protected $description = 'Shows which tables will be excluded from the dump';


    public function handle()
    {

        $allTables = DB::connection()->getDoctrineSchemaManager()->listTableNames();
        $excludedTables = array_diff($allTables, $this->whitelistedTables);

        $this->warn('Tables excluded from the data dump:');

        array_walk($excludedTables, function($item, $key) {
            $this->info($item);
        });

    }

}
