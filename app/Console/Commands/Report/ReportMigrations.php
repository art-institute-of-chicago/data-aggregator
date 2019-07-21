<?php

namespace App\Console\Commands\Report;

use App\Library\Shell;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportMigrations extends BaseCommand
{
    protected $signature = 'report:migrations {--refresh}';

    protected $description = 'Run migrate:generate and compare results with saved run';

    /**
     * We store user data in tables with `auth_` prefix, which is different
     * from our versioned prefix, so we need to reset the two separately.
     * See config/database.php and WEB-133 for more info.
     */
    private $connectionsToReset = [
        'mysql',
        'userdata',
    ];

    private $shell;

    /**
     * This command is meant to aid in refactoring migrations. Specifically, use this
     * when you want to squash or otherwise optimize migrations while keeping the end
     * schema the same. Workflow:
     *
     *  1. Checkout whatever commit contains the "reference" schema you want to keep.
     *  2. Set `DB_DATABASE` to point at a new, empty database. Alternatively, if you
     *     don't care about the data in your current database, you can run `db:reset`.
     *  3. Run `php artisan migrate`.
     *  4. Ensure the following directories exist:
     *       storage/app/migrations/old
     *       storage/app/migrations/new
     *  5. Run `php artisan migrate:generate --path storage/app/migrations/old`.
     *     Answer "no" to prompt. This is your reference schema. When you want to make
     *     a new reference schema, manually empty out `storage/app/migrations/old` and
     *     rerun this step.
     *  6. (Sanity check.) Run `php artisan report:migrations --refresh`. It should return empty.
     *  7. Modify some migrations and re-run `php artisan report:migrations --refresh`.
     *     If the schema changed, it'll return the difference. Else, it'll return empty.
     *
     * Repeat last step until refactoring is complete!
     */
    public function handle()
    {
        $this->shell = new Shell([
            'is_silent' => true,
            'non_zero_exit' => false,
        ]);

        $oldDir = storage_path('app/migrations/old');
        $newDir = storage_path('app/migrations/new');

        if ($this->option('refresh')) {
            foreach ($this->connectionsToReset as $connection) {
                $this->callSilent('db:reset', [
                    '--force' => 'default',
                    '--connection' => $connection,
                ]);
            }
        }

        array_map('unlink', $this->getFiles($newDir));

        $this->callSilent('migrate', [
            '--step' => 'default',
        ]);

        $this->callSilent('migrate:generate', [
            '--path' => $newDir,
            '--no-interaction' => 'default',
        ]);

        $newFiles = $this->getFiles($newDir);

        foreach ($newFiles as $newFile) {
            $filename = basename($newFile);
            $filename = substr($filename, 18);

            $oldFiles = $this->getFiles($oldDir, '*' . $filename);

            if (count($oldFiles) < 1) {
                throw new \Exception('Old migration not found: ' . $filename);
            }

            if (count($oldFiles) > 1) {
                throw new \Exception('Too many old migrations found: ' . $filename);
            }

            $oldFile = $oldFiles[0];

            $diff = $this->shell->exec('diff %s %s', $oldFile, $newFile);

            if ($diff['status'] === 1) {
                $this->warn($filename);
                $this->info(implode("\n", $diff['output']));
            }
        }
    }

    private function getFiles($dir, $suffix = '*.php')
    {
        return array_filter((array) glob($dir . '/' . $suffix));
    }
}
