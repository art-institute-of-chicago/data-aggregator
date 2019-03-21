<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\DB;
use League\Csv\Writer;
use Exception;
use Throwable;

class DumpDownload extends AbstractDumpCommand
{

    protected $signature = 'dump:download
                            {--no-import : Download only, do not import}';

    protected $description = 'Downloads dumps from remote repo and imports them into database';

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

            $this->passthru('rm -r %s', $repoPath);

        }

        if (!file_exists($repoPath))
        {
            $this->passthru('git clone %s %s', $repoRemote, $repoPath);
        }

        $this->passthru('git -C %s remote set-url origin %s', $repoPath, $repoRemote);
        $this->passthru('git -C %s fetch', $repoPath);
        $this->passthru('git -C %s checkout master', $repoPath);
        $this->passthru('git -C %s reset --hard origin/master', $repoPath);

        $this->warn('Repo downloaded to ' . $repoPath);

        if ($this->option('no-import'))
        {
            $this->warn('Aborting early to honor --no-import flag');
            exit;
        }

        $this->call('dump:import', [
            '--path' => $repoPath,
        ]);

    }
}
