<?php

namespace App\Console\Commands\Migrations;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use App\Library\Migrations\MigrationCreator;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

abstract class AbstractCommand extends BaseCommand
{
    private $doctrineTableCache = [];

    private $blueprintCache = [];

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
        return collect($this->manager->listTableNames())
            ->filter(function ($tableName) {
                // Only keep tables that start with our prefix
                return Str::startsWith($tableName, $this->prefix);
            })
            ->map(function ($tableName) {
                // Remove prefix from all table names
                return substr($tableName, strlen($this->prefix));
            })
            ->values();
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

    /**
     * Adapted from Illuminate\Database\Schema\Builder::createBlueprint()
     * Allows us to use e.g. our `hasIndex` macro defined in BluePrintServiceProvider
     */
    protected function getBlueprint($tableName)
    {
        return $this->blueprintCache[$tableName] ??= new Blueprint($tableName, null, $this->prefix);
    }

    protected function getMigrationPath()
    {
        return $this->laravel->databasePath() . DIRECTORY_SEPARATOR . 'migrations';
    }
}
