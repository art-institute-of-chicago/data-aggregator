<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class DumpImport extends AbstractDumpCommand
{

    protected $signature = 'dump:import
                            {--path= : Directory from where to import dump, with `tables` subdir }';

    protected $description = "Import CSV dumps of all whitelisted tables";

    protected $chunkSize = 100;

    public function handle()
    {
        // Export to database/dumps/local unless specified otherwise
        $dumpPath = $this->getDumpPathOption();

        foreach ($this->whitelistedTables as $tableName)
        {
            $this->info($tableName);

            $csvPath = $dumpPath . 'tables/' . $tableName . '.csv';

            if (!file_exists($csvPath))
            {
                $this->warn(' Skipped: CSV not found.');
                continue;
            }

            $csv = Reader::createFromPath($csvPath, 'r');
            $csv->setHeaderOffset(0);

            DB::table($tableName)->truncate();

            // http://csv.thephpleague.com/9.0/reader/#records-count`
            $bar = $this->output->createProgressBar(count($csv));
            $buffer = [];

            foreach ($csv as $offset => $record)
            {
                $record = array_map([$this, 'convertEmptyStringToNull'], $record);

                $buffer[] = $record;

                // SQL writes are really expensive, so we'll buffer them
                if (count($buffer) === $this->chunkSize)
                {
                    DB::table($tableName)->insert($buffer);
                    $buffer = [];

                    $bar->advance($this->chunkSize);
                }
            }

            // Process the last chunk
            DB::table($tableName)->insert($buffer);
            $buffer = [];

            $bar->finish();
            $this->output->newLine(1);
        }

    }

    /**
     * Unfortunately, we need to convert empty strings to null manually.
     * Use this as a callback in `array_map`.
     *
     * @link https://github.com/thephpleague/csv/issues/319
     */
    private function convertEmptyStringToNull($value)
    {
        return $value === '' ? null : $value;
    }

}
