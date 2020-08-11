<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\File;
use Exception;

class DumpUpload extends AbstractDumpCommand
{

    protected $signature = 'dump:upload
                            {--reset : Reset repo to initial commit}
                            {--remove : Delete and re-clone repo}';

    protected $description = 'Pushes the local dump to a remote repo';

    public function handle()
    {
        // Be sure to set these in your .env
        $this->validateEnv(['DUMP_REPO_REMOTE', 'DUMP_REPO_NAME', 'DUMP_REPO_EMAIL']);

        $repoRemote = env('DUMP_REPO_REMOTE');
        $repoPath = $this->getDumpPath('remote');

        // If you change this, you'll need to clean up the repo manually
        $jsonsSrcPath = $this->getDumpPath('local/json');
        $jsonsDestPath = $repoPath . '/json';
        $gettingStartedSrcPath = $this->getDumpPath('local/getting-started');
        $gettingStartedDestPath = $repoPath . '/getting-started';

        if ($this->isDirEmpty($jsonsSrcPath)) {
            throw new Exception('No JSON files found in ' . $jsonsSrcPath);
        }
        if ($this->isDirEmpty($gettingStartedSrcPath)) {
            throw new Exception('No getting started files found in ' . $gettingStartedSrcPath);
        }

        if ($this->option('remove') && file_exists($repoPath)) {
            $this->shell->passthru('rm -rf %s', $repoPath);
        }

        if (!file_exists($repoPath)) {
            $this->shell->passthru('git clone %s %s', $repoRemote, $repoPath);
        }

        $this->shell->passthru('git -C %s remote set-url origin %s', $repoPath, $repoRemote);
        $this->shell->passthru('git -C %s checkout master', $repoPath);
        $this->shell->passthru('git -C %s fetch', $repoPath);
        $this->shell->passthru('git -C %s reset --hard origin/master', $repoPath);

        // Optional: Reset repo to initial commit?
        // If you want to modify the documentation, make sure you amend initial commit!
        if ($this->option('reset')) {
            $commit = $this->shell->exec('git -C %s rev-list --max-parents=0 HEAD', $repoPath)['output'][0];
            $this->shell->passthru('git -C %s reset --hard %s', $repoPath, $commit);
        }

        // Remove all existing  JSONs from the repo
        // This should take care of any tables that were removed or renamed
        if (file_exists($jsonsDestPath)) {
            $this->shell->passthru('find %s -type d -exec bash -c \'rm "$0"/*\' {} \\;', $jsonsDestPath);
        } else {
            mkdir($jsonsDestPath);
        }
        if (file_exists($gettingStartedDestPath)) {
            $this->shell->passthru('rm %s/*', $gettingStartedDestPath);
        } else {
            mkdir($gettingStartedDestPath);
        }

        // Copy dumps of whitelisted tables and endpoints into the repo
        foreach ($this->getModels() as $model => $category) {
            if(!File::exists($jsonsSrcPath .'/' .app('Resources')->getEndpointForModel($model))) {
                continue;
            }

            $this->shell->passthru('mkdir -p %s', $jsonsDestPath . '/' .app('Resources')->getEndpointForModel($model));
            $this->shell->passthru('cp -r %s/* %s/', $jsonsSrcPath.'/' .app('Resources')->getEndpointForModel($model), $jsonsDestPath.'/' .app('Resources')->getEndpointForModel($model));
        }

        // Copy getting started files
        $this->shell->passthru('cp %s/* %s/', $gettingStartedSrcPath, $gettingStartedDestPath);

        // Add VERSION file with current commit
        $this->shell->passthru('git -C %s rev-parse HEAD > %s', base_path(), $repoPath . '/VERSION');

        // Add all files to index, commit, and push
        $this->shell->passthru('git -C %s add -A', $repoPath);

        $this->shell->passthru(
            'git -C %s -c %s -c %s commit --author %s -m "Update data"',
            $repoPath,
            'user.name=' . env('DUMP_REPO_NAME'),
            'user.email=' . env('DUMP_REPO_EMAIL'),
            env('DUMP_REPO_NAME') . ' <' . env('DUMP_REPO_EMAIL') . '>'
        );

        // TODO: Fix how this works without --reset?
        $this->shell->passthru('git -C %s push %s', $repoPath, ($this->option('reset') ? '--force' : '--no-force-with-lease'));
    }

    function isDirEmpty($dir) {
        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $file  = $dir.$entry;
                if (is_dir($file)) {
                    if (!$this->isDirEmpty($file)) {
                        closedir($handle);
                        return FALSE;
                    }
                }
                else {
                    closedir($handle);
                    return FALSE;
                }
            }
        }
        closedir($handle);
        return TRUE;
    }
}
