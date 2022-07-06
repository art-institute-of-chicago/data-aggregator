<?php

namespace App\Console\Commands\Migrations;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Library\Migrations\MigrationCreator;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

abstract class AbstractCommand extends BaseCommand
{
    private $doctrineTableCache = [];

    protected $creator;

    protected $manager;

    protected $prefix;

    public function __construct()
    {
        parent::__construct();

        $this->manager = DB::connection()->getDoctrineSchemaManager();
        $this->prefix = DB::connection()->getTablePrefix();
        $this->creator = new MigrationCreator(app('files'), app()->basePath('stubs'));
    }

    protected function getTables()
    {
        $tableNames = $this->manager->listTableNames();

        // Only keep tables that start with our prefix
        $tableNames = array_filter($tableNames, function ($tableName) {
            return Str::startsWith($tableName, $this->prefix);
        });

        // Remove prefix from all table names
        $tableNames = array_map(function ($tableName) {
            return substr($tableName, strlen($this->prefix));
        }, $tableNames);

        return array_values($tableNames);
    }

    protected function writeMigration($name)
    {
        $file = $this->creator->create(
            $name, $this->getMigrationPath()
        );

        $this->line("<info>Created Migration:</info> {$file}");
    }

    /**
     * See also `getDoctrineTable` macro in BlueprintServiceProvider.
     */
    protected function getDoctrineTable($tableName)
    {
        return $this->doctrineTableCache[$tableName] ??= $this->manager->listTableDetails($this->prefix . $tableName);
    }

    protected function getMigrationPath()
    {
        return $this->laravel->databasePath() . DIRECTORY_SEPARATOR . 'migrations';
    }
}
