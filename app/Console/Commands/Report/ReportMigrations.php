<?php

namespace App\Console\Commands\Report;

use App\Console\Helpers\InteractsWithShell;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportMigrations extends BaseCommand
{
    use InteractsWithShell;

    protected $signature = 'report:migrations';

    protected $description = 'Run migrate:generate and compare results with saved run';

    public function handle()
    {
        $oldDir = storage_path('app/migrations/old');
        $newDir = storage_path('app/migrations/new');

        array_map('unlink', $this->getFiles($newDir));

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
                throw \Exception('Old migration not found: ' . $filename);
            }

            if (count($oldFiles) > 1) {
                throw \Exception('Too many old migrations found: ' . $filename);
            }

            $oldFile = $oldFiles[0];

            $diff = $this->exec('diff %s %s', $oldFile, $newFile);

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
