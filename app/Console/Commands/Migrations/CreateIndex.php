<?php

namespace App\Console\Commands\Migrations;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use ColinODell\Indentation\Indentation;

class CreateIndex extends AbstractCommand
{
    protected $signature = 'make:migration-create-index {column}';

    protected $description = '';

    public function handle()
    {
        $columnName = $this->argument('column');

        $tableNames = $this
            ->getTables()
            ->filter(function ($tableName) use ($columnName) {
                // Only keep tables that have target column
                return Schema::hasColumn($tableName, $columnName);
            })
            ->filter(function ($tableName) use ($columnName) {
                // Only keep tables that don't have our index
                return !$this
                    ->getBlueprint($tableName)
                    ->hasIndex([$columnName]);
            })
            ->values()
            ->all();

        $name = sprintf('create_%s_index', $columnName);

        $this->creator->setStub('migration.create-index.stub');
        $this->creator->setPopulator(function ($stub) use ($columnName, $tableNames) {
            $stub = str_replace('{{ columnName }}', $columnName, $stub);
            $stub = str_replace('{{ tableNames }}', $this->prepareArray($tableNames), $stub);

            return $stub;
        });

        $this->writeMigration($name);
    }
}
