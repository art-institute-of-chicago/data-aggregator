<?php

namespace App\Console\Commands\Migrations;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Library\Migrations\MigrationCreator;
use ColinODell\Indentation\Indentation;
use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

abstract class AbstractCommand extends BaseCommand
{
    protected $creator;

    protected $prefix;

    public function __construct()
    {
        parent::__construct();

        $this->prefix = DB::connection()->getTablePrefix();
        $this->creator = new MigrationCreator(app('files'), app()->basePath('stubs'));
    }

    protected function getTables()
    {
        return collect(DB::connection()->getSchemaBuilder()->getTableListing())
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
            $name,
            $this->getMigrationPath()
        );

        $this->line("<info>Created Migration:</info> {$file}");
    }

    protected function getMigrationPath()
    {
        return $this->laravel->databasePath() . DIRECTORY_SEPARATOR . 'migrations';
    }

    protected function prepareArray(array $input)
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
    protected function encodeArray(array $expression)
    {
        $export = var_export($expression, true);

        $patterns = [
            "/array \(/" => '[',
            "/^([ ]*)\)(,?)$/m" => '$1]$2',
            "/=>[ ]?\n[ ]+\[/" => '=> [',
            "/([ ]*)(\'[^\']+\') => ([\[\'])/" => '$1$2 => $3',
        ];

        return preg_replace(array_keys($patterns), array_values($patterns), $export);
    }
}
