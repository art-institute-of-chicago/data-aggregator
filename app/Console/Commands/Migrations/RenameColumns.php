<?php

namespace App\Console\Commands\Migrations;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

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
        return $this
            ->getTables()
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
}
