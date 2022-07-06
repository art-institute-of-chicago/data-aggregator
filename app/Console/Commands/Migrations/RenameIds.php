<?php

namespace App\Console\Commands\Migrations;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use ColinODell\Indentation\Indentation;

class RenameIds extends AbstractCommand
{
    protected $signature = 'make:migration-rename-ids {oldNeedle} {newNeedle}';

    protected $description = '';

    public function handle()
    {
        $oldNeedle = $this->argument('oldNeedle');
        $newNeedle = $this->argument('newNeedle');

        $columns = $this->getColumns($oldNeedle, $newNeedle);

        $name = sprintf('rename_%s_to_%s', $oldNeedle, $newNeedle);

        $this->creator->setStub('migration.rename-ids.stub');
        $this->creator->setPopulator(function ($stub) use ($columns) {
            $stub = str_replace('{{ columns }}', $this->prepareArray($columns), $stub);

            return $stub;
        });

        $this->writeMigration($name);
    }

    private function getColumns($oldNeedle, $newNeedle)
    {
        return collect(
                $this->getTables()
            )
            ->map(function ($tableName) use ($oldNeedle, $newNeedle) {
                $columnNames = collect(
                        Schema::getColumnListing($tableName)
                    )
                    ->filter(
                        fn ($columnName) => Str::contains($columnName, $oldNeedle)
                    )
                    ->map(
                        fn ($columnName) => [
                            $columnName => str_replace($oldNeedle, $newNeedle, $columnName)
                        ]
                    )
                    ->collapse();

                if ($columnNames->isEmpty()) {
                    return;
                }

                return [
                    $tableName => $columnNames->all(),
                ];
            })
            ->filter()
            ->collapse()
            ->all();
    }

    private function prepareArray(array $input)
    {
        $output = $this->encodeArray($input);

        $output = Indentation::change($output, new Indentation(4, Indentation::TYPE_SPACE));
        $output = Indentation::indent($output, new Indentation(4, Indentation::TYPE_SPACE));
        $output = ltrim($output);

        return $output;
    }

    /**
     * @link https://www.php.net/manual/en/function.var-export.php#124194
     */
    private function encodeArray(array $expression)
    {
        $export = var_export($expression, TRUE);

        $patterns = [
            "/array \(/" => '[',
            "/^([ ]*)\)(,?)$/m" => '$1]$2',
            "/=>[ ]?\n[ ]+\[/" => '=> [',
            "/([ ]*)(\'[^\']+\') => ([\[\'])/" => '$1$2 => $3',
        ];

        return preg_replace(array_keys($patterns), array_values($patterns), $export);
    }
}
