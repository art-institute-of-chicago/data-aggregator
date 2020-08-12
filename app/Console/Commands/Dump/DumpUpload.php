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

        // Remove all existing JSONs from the repo
        // This should take care of any tables that were removed or renamed
        $prefixes = ['00','01','02','03','04','05','06','07','08','09'];
        $prefixes = array_merge($prefixes,range(10, 99));
        $prefixes = array_merge($prefixes,['a0','a1','a2','a3','a4','a5','a6','a7','a8','a9','aa','ab','ac','ad','ae','af']);
        $prefixes = array_merge($prefixes,['b0','b1','b2','b3','b4','b5','b6','b7','b8','b9','ba','bb','bc','bd','be','bf']);
        $prefixes = array_merge($prefixes,['c0','c1','c2','c3','c4','c5','c6','c7','c8','c9','ca','cb','cc','cd','ce','cf']);
        $prefixes = array_merge($prefixes,['d0','d1','d2','d3','d4','d5','d6','d7','d8','d9','da','db','dc','dd','de','df']);
        $prefixes = array_merge($prefixes,['e0','e1','e2','e3','e4','e5','e6','e7','e8','e9','ea','eb','ec','ed','ee','ef']);
        $prefixes = array_merge($prefixes,['f0','f1','f2','f3','f4','f5','f6','f7','f8','f9','fa','fb','fc','fd','fe','ff']);

        if (file_exists($jsonsDestPath)) {
            foreach ($prefixes as $prefix) {
                $this->shell->passthru('find %s -type d -exec bash -c \'rm -f "$0"/%s*\' {} \\;', $jsonsDestPath, $prefix);
            }
            $this->shell->passthru('find %s -type d -exec bash -c \'rm -f "$0"/*\' {} \\;', $jsonsDestPath);
        } else {
            mkdir($jsonsDestPath);
        }
        if (file_exists($gettingStartedDestPath)) {
            $this->shell->passthru('rm -f %s/*', $gettingStartedDestPath);
        } else {
            mkdir($gettingStartedDestPath);
        }

        // Copy dumps of whitelisted tables and endpoints into the repo
        foreach ($this->getModels() as $model => $category) {
            $endpoint = app('Resources')->getEndpointForModel($model);

            if(!File::exists($jsonsSrcPath .'/' .$endpoint)) {
                continue;
            }

            $this->shell->passthru('mkdir -p %s', $jsonsDestPath . '/' .$endpoint);
            $this->shell->passthru('rsync -r %s %s', $jsonsSrcPath .'/' .$endpoint, $jsonsDestPath);
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
