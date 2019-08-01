<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class DumpImport extends AbstractDumpCommand
{

    protected $signature = 'dump:import
                            {--path= : Directory from where to import dump, with `tables` subdir }
                            {--from-remote : Shortcut to import from `database/dumps/remote` }';

    protected $description = 'Import CSV dumps of all whitelisted tables';

    protected $chunkSize = 100;

    public function handle()
    {
        if ($this->option('from-remote')) {
            $this->input->setOption('path', $this->getDumpPath('remote'));
        }

        // Import from database/dumps/local unless specified otherwise
        $dumpPath = $this->getDumpPathOption();

        foreach ($this->whitelistedTables as $tableName)
        {
            $this->info($tableName);

            $csvPaths = $this->shell->exec('find %s -name %s', $dumpPath . 'tables', $tableName . '*.csv')['output'];

            // Fix issues e.g. with artwork_place and artwork_place_qualifiers
            $csvPaths = array_values(array_filter($csvPaths, function ($csvPath) use ($tableName) {
                return preg_match('/' . $tableName . '(?:-[0-9]+)?\.csv/', basename($csvPath));
            }));

            if (count($csvPaths) < 1) {
                $this->warn(' Skipped: CSV not found.');
                continue;
            }

            DB::table($tableName)->truncate();

            foreach ($csvPaths as $csvPath)
            {
                $csv = Reader::createFromPath($csvPath, 'r');
                $csv->setHeaderOffset(0);

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
