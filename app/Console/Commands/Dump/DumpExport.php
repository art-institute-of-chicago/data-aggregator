<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;
use Exception;
use Throwable;

class DumpExport extends AbstractDumpCommand
{

    protected $signature = 'dump:export
                            {--path= : Directory where to save dump, with `tables` subdir }';

    protected $description = 'Create CSV dumps of all whitelisted tables';

    protected $maxCsvFileSize = 25 * 1024 * 1024;

    public function handle()
    {
        // Export to database/dumps/local unless specified otherwise
        $dumpPath = $this->getDumpPathOption() . 'tables/';

        // Remove any old CSVs in this dump
        array_map('unlink', glob($dumpPath . '*.csv') ?: []);

        // Ensure all tables are ready for export
        $tables = $this->getPreparedTables();

        foreach($tables as $table)
        {
            $csvPart = 1;
            $csvPath = $dumpPath . $table['name'] . '.csv';

            $csv = $this->getNewWriter($csvPath, $table['allColumns']);

            // Give feedback to the user
            $this->info($table['name']);
            $bar = $this->output->createProgressBar($table['count']);

            // Chunking requires us to set orderBy, so we use our primary key column(s)
            $query = DB::table($table['name']);

            foreach ($table['keyColumns'] as $column)
            {
                $query->orderBy($column);
            }

            // TODO: Consider moving some of these to instance variables?
            $query->chunk(100, function ($items) use (&$csv, &$csvPart, $dumpPath, $csvPath, $bar, $table) {

                // Unfortunately there's no way to set PDO::FETCH_ASSOC
                // https://github.com/laravel/framework/issues/17557
                $items = $items->map(function ($item) {
                    return (array) $item;
                });

                $csv->insertAll($items);
                $bar->advance($items->count());

                clearstatcache();

                if (filesize($csvPath) > $this->maxCsvFileSize) {
                    rename($csvPath, $dumpPath . $table['name'] . '-' . $csvPart . '.csv');
                    $csv = $this->getNewWriter($csvPath, $table['allColumns']);
                    $csvPart++;
                }
            });

            $bar->finish();
            $this->output->newLine(1);

            if ($csvPart > 1) {
                rename($csvPath, $dumpPath . $table['name'] . '-' . $csvPart . '.csv');
            }
        }

    }

    private function getNewWriter($csvPath, $header)
    {
        $csv = Writer::createFromPath($csvPath, 'w');
        $csv->insertOne($header);
        return $csv;
    }

    private function getPreparedTables()
    {

        return collect($this->whitelistedTables)->map(function ($tableName) {

            $prefixedTableName = DB::getTablePrefix() . $tableName;

            // Illuminate\Database\Schema\MySqlBuilder auto-prepends prefix
            if (!Schema::hasTable($tableName)) {
                throw new Exception('Table does not exist ' . $prefixedTableName);
            }

            $table = DB::connection()->getDoctrineSchemaManager()->listTableDetails($prefixedTableName);

            try {

                $keyColumns = $table->getPrimaryKey()->getColumns();

            } catch (Throwable $e) {

                throw new Exception('Primary key missing in table ' . $prefixedTableName);

            }

            return [
                'name' => $tableName,
                'allColumns' => array_keys($table->getColumns()), // Doctrine\DBAL\Schema\Column values
                'keyColumns' => $keyColumns,
                'count' => DB::table($tableName)->count(),
            ];

        });

    }

}
