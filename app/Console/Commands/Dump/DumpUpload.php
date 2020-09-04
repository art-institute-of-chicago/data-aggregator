<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\File;
use Exception;

class DumpUpload extends AbstractDumpCommand
{

    protected $signature = 'dump:upload';

    protected $description = 'Pushes the local dump to a remote repo';

    public function handle()
    {
        // Be sure to set these in your .env
        $this->validateEnv(['DUMP_REPO_REMOTE', 'DUMP_REPO_NAME', 'DUMP_REPO_EMAIL']);

        $repoRemote = env('DUMP_REPO_REMOTE');
        $repoPath = $this->getDumpPath('remote');
        $srcPath = $this->getDumpPath('local');

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

        $this->shell->passthru('rm -rf %s/*', $repoPath);
        $this->shell->passthru('rm -rf %s/.git', $repoPath);

        $this->shell->passthru('git -C %s init', $repoPath);

        $this->shell->passthru('git -C %s remote add origin %s', $repoPath, $repoRemote);

        // Copy dumps of whitelisted tables and endpoints into the repo
        $this->shell->passthru('rsync -r --exclude \'.gitignore\' %s/ %s', $srcPath, $repoPath);

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

        $this->shell->passthru('git -C %s push --set-upstream origin master %s', $repoPath, '--force');
    }

    function isDirEmpty($dir)
    {
        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $file  = $dir.$entry;
                if (is_dir($file)) {
                    if (!$this->isDirEmpty($file)) {
                        closedir($handle);
                        return false;
                    }
                } else {
                    closedir($handle);
                    return false;
                }
            }
        }
        closedir($handle);
        return true;
    }
}
