<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\DB;
use League\Csv\Writer;
use Exception;
use Throwable;

class DumpExport extends AbstractDumpCommand
{

    protected $signature = 'dump:export
                            {--path= : Directory where to save dump, with `tables` subdir }';

    protected $description = 'Create CSV dumps of all whitelisted tables';

    public function handle()
    {
        // Export to database/dumps/local unless specified otherwise
        $dumpPath = $this->getDumpPathOption();

        // Ensure all tables are ready for export
        $tables = $this->getPreparedTables();

        foreach($tables as $table)
        {
            $csv = Writer::createFromPath($dumpPath . $table['csvPath'], 'w');

            // Create the CSV header
            $csv->insertOne($table['allColumns']);

            // Give feedback to the user
            $this->info($table['name']);
            $bar = $this->output->createProgressBar($table['count']);

            // Chunking requires us to set orderBy, so we use our primary key column(s)
            $query = DB::table($table['name']);

            foreach ($table['keyColumns'] as $column)
            {
                $query->orderBy($column);
            }

            $query->chunk(100, function($items) use ($csv, $bar) {

                // Unfortunately there's no way to set PDO::FETCH_ASSOC
                // https://github.com/laravel/framework/issues/17557
                $items = $items->map(function($item) {
                    return (array) $item;
                });

                $csv->insertAll($items);
                $bar->advance($items->count());
            });

            $bar->finish();
            $this->output->newLine(1);
        }

    }

    private function getPreparedTables()
    {

        return collect($this->whitelistedTables)->map( function($tableName) {

            $table = DB::connection()->getDoctrineSchemaManager()->listTableDetails($tableName);

            try {

                $keyColumns = $table->getPrimaryKey()->getColumns();

            } catch (Throwable $e) {

                throw new Exception('Primary key missing in table ' . $tableName);

            }

            return [
                'name' => $tableName,
                'csvPath' => 'tables/' . $tableName . '.csv',
                'allColumns' => array_keys($table->getColumns()), // Doctrine\DBAL\Schema\Column values
                'keyColumns' => $keyColumns,
                'count' => DB::table($tableName)->count(),
            ];

        });

    }

}
