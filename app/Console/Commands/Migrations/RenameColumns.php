<?php

namespace App\Console\Commands\Migrations;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use ColinODell\Indentation\Indentation;

class RenameColumns extends AbstractCommand
{
    protected $signature = 'make:migration-rename-columns {oldNeedle} {newNeedle}';

    protected $description = '';

    public function handle()
    {
        $oldNeedle = $this->argument('oldNeedle');
        $newNeedle = $this->argument('newNeedle');

        $columns = $this->getColumns($oldNeedle, $newNeedle);
        $indexes = $this->getIndexes($oldNeedle, $newNeedle);

        $name = sprintf('rename_%s_to_%s', $oldNeedle, $newNeedle);

        $this->creator->setStub('migration.rename-ids.stub');
        $this->creator->setPopulator(function ($stub) use ($columns, $indexes) {
            $stub = str_replace('{{ columns }}', $this->prepareArray($columns), $stub);
            $stub = str_replace('{{ indexes }}', $this->prepareArray($indexes), $stub);

            return $stub;
        });

        $this->writeMigration($name);
    }

    private function getColumns($oldNeedle, $newNeedle)
    {
        return $this->getMapping($oldNeedle, $newNeedle, function ($tableName) {
            return Schema::getColumnListing($tableName);
        });
    }

    private function getIndexes($oldNeedle, $newNeedle)
    {
        return $this->getMapping($oldNeedle, $newNeedle, function ($tableName) {
            return array_map(
                fn ($index) => substr($index->getName(), strlen($this->prefix)),
                $this->manager->listTableIndexes($this->prefix . $tableName)
            );
        });
    }

    private function getMapping($oldNeedle, $newNeedle, $tableCallback)
    {
        return collect(
                $this->getTables()
            )
            ->map(function ($tableName) use ($oldNeedle, $newNeedle, $tableCallback) {
                $itemNames = collect(
                        $tableCallback($tableName)
                    )
                    ->filter(
                        fn ($itemName) => Str::contains($itemName, $oldNeedle)
                    )
                    ->map(
                        fn ($itemName) => [
                            $itemName => str_replace($oldNeedle, $newNeedle, $itemName)
                        ]
                    )
                    ->collapse();

                if ($itemNames->isEmpty()) {
                    return;
                }

                return [
                    $tableName => $itemNames->all(),
                ];
            })
            ->filter()
            ->collapse()
            ->all();
    }

    private function prepareArray(array $input)
    {
        $output = empty($input)
            ? '[' . PHP_EOL . '    // nothing to change' . PHP_EOL . ']'
            : $this->encodeArray($input);

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
