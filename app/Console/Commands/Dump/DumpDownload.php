<?php

namespace App\Console\Commands\Dump;

class DumpDownload extends AbstractDumpCommand
{

    protected $signature = 'dump:download';

    protected $description = 'Downloads dumps from the remote repo';

    public function handle()
    {
        $this->validateEnv(['DUMP_REPO_REMOTE']);

        $repoRemote = env('DUMP_REPO_REMOTE');
        $repoPath = $this->getDumpPath('remote');

        if (file_exists($repoPath) && !file_exists($repoPath . '/.git'))
        {
            $this->warn($repoPath . ' exists, but is not a git repository.');

            if (!$this->confirm('OK to remove existing directory?'))
            {
                $this->warn('Aborting. Please provide path to repo.');
                exit(1);
            }

            $this->shell->passthru('rm -r %s', $repoPath);
        }

        if (!file_exists($repoPath))
        {
            $this->shell->passthru('git clone %s %s', $repoRemote, $repoPath);
        }

        $this->shell->passthru('git -C %s remote set-url origin %s', $repoPath, $repoRemote);
        $this->shell->passthru('git -C %s fetch', $repoPath);
        $this->shell->passthru('git -C %s checkout master', $repoPath);
        $this->shell->passthru('git -C %s reset --hard origin/master', $repoPath);

        $this->warn('Repo downloaded to ' . $repoPath);

        if ($this->confirm('Import downloaded data into the current database? Current data will be lost.')) {
            $this->call('dump:import', [
                '--path' => $repoPath,
            ]);
        } else {
            $this->info('To import downloaded data later, run the following command:');
            $this->output->newLine(1);
            $this->info('    ' . 'php artisan dump:import --from-remote');
            $this->output->newLine(1);
        }
    }
}
