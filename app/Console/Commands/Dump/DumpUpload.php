<?php

namespace App\Console\Commands\Dump;

use Illuminate\Http\File;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Process;
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

        // Git
        FileFacade::deleteDirectory($repoPath);
        FileFacade::makeDirectory($repoPath);
        Process::path($repoPath)->run(
            ['git', 'config', '--global', 'init.defaultBranch', 'main'],
            $this->streamOutput()
        )->throw();
        Process::path($repoPath)->run(['git', 'init'], $this->streamOutput())->throw();

        Process::run(
            ['git', 'config', '--global', '--add', 'safe.directory', $repoPath],
            $this->streamOutput()
        )->throw();
        Process::path($repoPath)->run(
            ['git', 'remote', 'add', 'origin', $repoRemote],
            $this->streamOutput()
        )->throw();

        // Copy README into the repo
        FileFacade::copy(resource_path('api-data-readme.md'), $repoPath . '/README.md');

        // Copy COC into the repo
        FileFacade::copy(base_path('CODE_OF_CONDUCT.md'), $repoPath . '/CODE_OF_CONDUCT.md');

        // Copy dumps of whitelisted tables and endpoints into the repo
        Process::run(
            ['rsync', '-r', '--', $srcPath . '/getting-started/', $gettingStartedDestPath],
            $this->streamOutput()
        )->throw();

        foreach (FileFacade::files($srcPath) as $file) {
            FileFacade::copy($file->getPathname(), $repoPath . '/' . $file->getFilename());
        }

        FileFacade::makeDirectory($jsonsDestPath);

        $endpoints = array_map('basename', FileFacade::directories($jsonsSrcPath));

        // First, copy only 10 items from each endpoint
        foreach ($endpoints as $endpoint) {
            FileFacade::makeDirectory($jsonsDestPath . '/' . $endpoint);

            // Sort plain filenames instead of building file objects, since some endpoints have 100k+ files
            $filenames = scandir($jsonsSrcPath . '/' . $endpoint);
            sort($filenames, SORT_NATURAL);

            $copied = 0;

            foreach ($filenames as $filename) {
                $file = $jsonsSrcPath . '/' . $endpoint . '/' . $filename;

                if (str_starts_with($filename, '.') || !is_file($file)) {
                    continue;
                }

                FileFacade::copy($file, $jsonsDestPath . '/' . $endpoint . '/' . $filename);

                if (++$copied === 10) {
                    break;
                }
            }
        }

        // Copy info.json and config.json
        FileFacade::copy($srcPath . '/json/info.json', $repoPath . '/json/info.json');
        FileFacade::copy($srcPath . '/json/config.json', $repoPath . '/json/config.json');

        // Add VERSION file with current commit
        $version = Process::path(base_path())->run(['git', 'rev-parse', 'HEAD'])->throw()->output();
        FileFacade::put($repoPath . '/VERSION', $version);

        // Add all files to index, commit, and push
        Process::path($repoPath)->run(['git', 'add', '-A'], $this->streamOutput())->throw();

        Process::path($repoPath)->run([
            'git',
            '-c', 'user.name=' . config('aic.dump.repo_name'),
            '-c', 'user.email=' . config('aic.dump.repo_email'),
            'commit',
            '--author', config('aic.dump.repo_name') . ' <' . config('aic.dump.repo_email') . '>',
            '-m', 'Update data',
        ], $this->streamOutput())->throw();

        Process::path($repoPath)->run(['git', 'branch', '-M', 'main'], $this->streamOutput())->throw();
        Process::path($repoPath)->forever()->run(
            ['git', 'push', '--set-upstream', 'origin', 'main', '--force'],
            $this->streamOutput()
        )->throw();

        // Hugging Face
        $parquetPath = $srcPath . '/jsonl';
        $hfUpload = null;

        if (config('aic.dump.hugging_face_token')) {
            $this->validateConfig(['aic.dump.hugging_face_repo']);

            $parquetFiles = glob($parquetPath . '/*.parquet');

            if (empty($parquetFiles)) {
                throw new Exception('No parquet files found in ' . $parquetPath);
            }

            // Generate the dataset card, with one config per endpoint so the dataset viewer
            // doesn't try to combine files with different schemas into a single table
            $configs = collect($parquetFiles)
                ->map(fn ($file) => basename($file, '.parquet'))
                ->map(fn ($endpoint) => implode("\n", array_filter([
                    '- config_name: ' . $endpoint,
                    '  data_files: ' . $endpoint . '.parquet',
                    $endpoint === 'artworks' ? '  default: true' : null,
                ])))
                ->implode("\n");

            file_put_contents(
                $parquetPath . '/README.md',
                str_replace('{{configs}}', $configs, file_get_contents(resource_path('api-data-hugging-face-readme.md')))
            );

            $repoId = config('aic.dump.hugging_face_repo');

            // Pass the token through the environment so it doesn't show up in the process list
            $hfEnv = ['HF_TOKEN' => config('aic.dump.hugging_face_token')];

            // Only upload parquet files and the dataset card, and remove remote parquet files that no longer exist
            // locally. Run it in the background while the archive is built, and wait for it before cleanup.
            $hfUpload = Process::env($hfEnv)->forever()->start([
                'hf', 'upload', $repoId, $parquetPath, '.',
                '--repo-type=dataset',
                '--include=*.parquet',
                '--include=README.md',
                '--delete=*.parquet',
                '--commit-message=Update data',
            ], $this->streamOutput());
        } else {
            $this->warn('Skipping Hugging Face upload: `aic.dump.hugging_face_token` is not set');
        }

        $archiveName = 'artic-api-data';
        $archiveFile = $archiveName . '.tar.bz2';
        $archivePath = $this->getDumpPath($archiveFile);

        // Archive everything in the repo except its sample `json`, then the full `json` straight from the source,
        // so the full dataset doesn't have to be copied into the repo first. List the repo's entries explicitly
        // instead of using `--exclude=./json`, since tar would apply that to the source's `./json` too.
        $repoEntries = collect(scandir($repoPath))
            ->reject(fn ($entry) => in_array($entry, ['.', '..', 'json']))
            ->map(fn ($entry) => './' . $entry)
            ->all();

        // Create (-c) tar archive file (-f) with bzip2 (-j) with verbose output (-v)
        // cd (-C) to each path and target relative (./) to avoid putting the full absolute path hierarchy inside archive
        // transform archive members so they start in `artic-api-data` directory instead of `.`
        Process::forever()->run([
            'tar', '--transform', 's:^.:' . $archiveName . ':', '-cvjf', $archivePath,
            '-C', $repoPath, ...$repoEntries,
            '-C', $srcPath, './json',
        ], $this->streamOutput())->throw();

        // Stream the file to S3; be sure to set `AWS_BUCKET` in `.env` and otherwise configure credentials
        Storage::disk('s3')->putFileAs('/', new File($archivePath), $archiveFile);

        // The upload reads from `$srcPath`, so it has to finish before cleanup
        if ($hfUpload) {
            $hfUpload->wait()->throw();

            Process::env($hfEnv)->forever()->run([
                'python3', '-c',
                'import sys; from huggingface_hub import HfApi; '
                    . 'HfApi().super_squash_history(sys.argv[1], repo_type="dataset", commit_message="Update data")',
                $repoId,
            ], $this->streamOutput())->throw();
        }

        // Remove dumps to reduce deploy times (chown)
        FileFacade::deleteDirectory($repoPath);

        // `rm -rf` is much faster than PHP for the full dump's hundreds of thousands of files
        Process::forever()->run(['rm', '-rf', '--', $srcPath])->throw();
    }

    protected function isDirEmpty($dir)
    {
        $handle = opendir($dir);

        while (false !== ($entry = readdir($handle))) {
            if ($entry != '.' && $entry != '..') {
                $file = $dir . '/' . $entry;

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
