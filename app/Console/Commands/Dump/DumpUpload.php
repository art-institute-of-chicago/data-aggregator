<?php

namespace App\Console\Commands\Dump;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Exception;

class DumpUpload extends AbstractDumpCommand
{
    protected $signature = 'dump:upload';

    protected $description = 'Pushes the local dump to a remote repo';

    public function handle()
    {
        // Be sure to set these in your .env
        $this->validateConfig(['aic.dump.repo_remote', 'aic.dump.repo_name', 'aic.dump.repo_email']);

        $repoRemote = config('aic.dump.repo_remote');
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

        $this->shell->passthru('rm -rf %s', $repoPath);
        $this->shell->passthru('mkdir %s', $repoPath);
        $this->shell->passthru('git -C %s init', $repoPath);

        $this->shell->passthru('git -C %s remote add origin %s', $repoPath, $repoRemote);

        // Copy README into the repo
        $this->shell->exec(
            'cp %s %s',
            resource_path('api-data-readme.md'),
            $repoPath . '/README.md'
        );

        // Copy COC into the repo
        $this->shell->exec(
            'cp %s %s',
            base_path('CODE_OF_CONDUCT.md'),
            $repoPath . '/CODE_OF_CONDUCT.md'
        );

        // Copy dumps of whitelisted tables and endpoints into the repo
        $this->shell->passthru('rsync -r %s/ %s', $srcPath . '/getting-started', $repoPath . '/getting-started');
        $this->shell->passthru('
            for file in %s/*; do
                if [ -f $file ]; then
                    cp %s/$(basename $file) %s/
                fi
            done
        ', $srcPath, $srcPath, $repoPath);
        $this->shell->passthru('mkdir %s', $repoPath . '/json');

        $endpointResult = $this->shell->exec('
            for DIR_SRC in %s/json/*; do
                if [ -d "$DIR_SRC" ]; then
                    DIR_DEST=%s/json/$(basename "$DIR_SRC")
                    mkdir "$DIR_DEST"
                    echo "$(basename "$DIR_SRC")"
                fi
            done
        ', $srcPath, $repoPath);

        // First, copy only 10 items from each endpoint
        foreach ($endpointResult['output'] as $endpoint) {
            // https://stackoverflow.com/questions/11296809/how-to-avoid-ls-write-error-broken-pipe-with-php-exec
            $fileResult = $this->shell->exec('ls -p1 %s/json/%s | grep -v / | sort -n -k1 2>/dev/null | head -10', $srcPath, $endpoint);

            foreach ($fileResult['output'] as $file) {
                $this->shell->exec(
                    'cp %s/json/%s/%s %s/json/%s',
                    $srcPath,
                    $endpoint,
                    $file,
                    $repoPath,
                    $endpoint
                );
            }
        }

        // Copy info.json and config.json
        $this->shell->passthru('cp %s %s', $srcPath . '/json/info.json', $repoPath . '/json/info.json');
        $this->shell->passthru('cp %s %s', $srcPath . '/json/config.json', $repoPath . '/json/config.json');

        // Add VERSION file with current commit
        $this->shell->passthru('git -C %s rev-parse HEAD > %s', base_path(), $repoPath . '/VERSION');

        // Add all files to index, commit, and push
        $this->shell->passthru('git -C %s add -A', $repoPath);

        $this->shell->passthru(
            'git -C %s -c %s -c %s commit --author %s -m "Update data"',
            $repoPath,
            'user.name=' . config('aic.dump.repo_name'),
            'user.email=' . config('aic.dump.repo_email'),
            config('aic.dump.repo_name') . ' <' . config('aic.dump.repo_email') . '>'
        );

        $this->shell->passthru('git -C %s push --set-upstream origin main %s', $repoPath, '--force');

        // Now, copy full dataset (takes about 1 min 45 sec)
        $this->shell->passthru('rsync -r %s/ %s', $srcPath . '/json', $repoPath . '/json');

        $archiveName = 'artic-api-data';
        $archiveFile = $archiveName . '.tar.bz2';
        $archivePath = $this->getDumpPath($archiveFile);

        // Create (-c) tar archive file (-f) with bzip2 (-j) with verbose output (-v)
        // cd (-C) to repo path and target relative (./) to avoid putting the full absolute path hierarchy inside archive
        // transform archive members so they start in `artic-api-data` directory instead of `.`
        // omitting / from . in sed expression makes it so that . itself gets transformed
        $this->shell->passthru("tar --transform 's:^.:%s:' -cvjf %s -C %s ./", $archiveName, $archivePath, $repoPath);

        // Stream the file to S3; be sure to set `AWS_BUCKET` in `.env` and otherwise configure credentials
        Storage::disk('s3')->putFileAs('/', new File($archivePath), $archiveFile);

        // Remove dumps to reduce deploy times (chown)
        $this->shell->passthru('rm -rf %s', $repoPath);
        $this->shell->passthru('rm -rf %s', $srcPath);
    }

    protected function isDirEmpty($dir)
    {
        $handle = opendir($dir);

        while (false !== ($entry = readdir($handle))) {
            if ($entry != '.' && $entry != '..') {
                $file = $dir . $entry;

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
