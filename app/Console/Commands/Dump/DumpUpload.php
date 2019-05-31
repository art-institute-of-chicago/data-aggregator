<?php

namespace App\Console\Commands\Dump;

use Exception;

class DumpUpload extends AbstractDumpCommand
{

    protected $signature = 'dump:upload
                            {--reset : Reset repo to initial commit}
                            {--remove : Delete and re-clone repo}';

    protected $description = 'Pushes the local dump to a remote repo';


    public function handle()
    {

        # Be sure to set these in your .env
        $this->validateEnv(['DUMP_REPO_REMOTE', 'DUMP_REPO_NAME', 'DUMP_REPO_EMAIL']);

        $repoRemote = env('DUMP_REPO_REMOTE');
        $repoPath = $this->getDumpPath('remote');

        # If you change these, you'll need to clean up the repo manually
        $tablesSrcPath = $this->getDumpPath('local/tables');
        $tablesDestPath = $repoPath . '/tables';

        if (count(glob($tablesSrcPath . '/*.csv') ?: []) < 1)
        {
            throw new Exception('No CSV files found in ' . $tablesSrcPath);
        }

        if ($this->option('remove') && file_exists($repoPath))
        {
            $this->shell->passthru('rm -rf %s', $repoPath);
        }

        if (!file_exists($repoPath))
        {
            $this->shell->passthru('git clone %s %s', $repoRemote, $repoPath);
        }

        $this->shell->passthru('git -C %s remote set-url origin %s', $repoPath, $repoRemote);
        $this->shell->passthru('git -C %s checkout master', $repoPath);
        $this->shell->passthru('git -C %s fetch', $repoPath);
        $this->shell->passthru('git -C %s reset --hard origin/master', $repoPath);

        # Optional: Reset repo to initial commit?
        # If you want to modify the documentation, make sure you amend initial commit!
        if ($this->option('reset'))
        {
            $commit = $this->shell->exec('git -C %s rev-list --max-parents=0 HEAD', $repoPath)[0];
            $this->shell->passthru('git -C %s reset --hard %s', $repoPath, $commit);
        }

        # Remove all existing CSVs from the repo
        # This should take care of any tables that were removed or renamed
        if (file_exists($tablesDestPath))
        {
            $this->shell->passthru('find %s -name *.csv | xargs rm', $tablesDestPath);
        }

        # Copy our dumps into the repo
        $this->shell->passthru('cp -r %s %s', $tablesSrcPath, $repoPath);

        # Add all files to index, commit, and push
        $this->shell->passthru('git -C %s add -A', $repoPath);

        $this->shell->passthru(
            'git -C %s -c %s -c %s commit --author %s -m "Update CSVs"',
            $repoPath,
            'user.name=' . env('DUMP_REPO_NAME'),
            'user.email=' . env('DUMP_REPO_EMAIL'),
            env('DUMP_REPO_NAME') . ' <' . env('DUMP_REPO_EMAIL') . '>'
        );

        $this->shell->passthru('git -C %s push %s', $repoPath, ($this->option('reset') ? '--force' : ''));

    }

}
