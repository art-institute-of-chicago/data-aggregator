<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\DB;
use Exception;

class DumpUpload extends AbstractDumpCommand
{

    protected $signature = 'dump:upload
                            {--reset : Reset repo to initial commit}';

    protected $description = "Pushes the current dump to a remote repo";


    public function handle()
    {

        # Be sure to set these in your .env
        $this->validateEnv(['DUMP_REPO_REMOTE', 'DUMP_REPO_NAME', 'DUMP_REPO_EMAIL']);

        $repoRemote = env('DUMP_REPO_REMOTE');
        $repoPath = $this->getDumpPath('repo');

        # If you change these, you'll need to clean up the repo manually
        $tablesSrcPath = $this->getDumpPath('tables');
        $tablesDestPath = $repoPath . '/tables';

        if (count(glob($tablesSrcPath . '/*.csv') ?: []) < 1)
        {
            throw new Exception('No CSV files found in ' . $tablesSrcPath);
        }

        // For debug: remove existing repo?
        // if (file_exists($repoPath))
        // {
        //     $this->passthru('rm -r %s', $repoPath);
        // }

        if (!file_exists($repoPath))
        {
            $this->passthru('git clone %s %s', $repoRemote, $repoPath);
        }

        $this->passthru('git -C %s checkout master', $repoPath);
        $this->passthru('git -C %s fetch', $repoPath);
        $this->passthru('git -C %s reset --hard origin/master', $repoPath);

        # Optional: Reset repo to initial commit?
        # If you want to modify the documentation, make sure you amend initial commit!
        if ($this->option('reset'))
        {
            $commit = $this->exec('git -C %s rev-list --max-parents=0 HEAD', $repoPath)[0];
            $this->passthru('git -C %s reset --hard %s', $repoPath, $commit);
        }

        # Remove all existing CSVs from the repo
        # This should take care of any tables that were removed or renamed
        if (file_exists($tablesDestPath))
        {
            $this->passthru('find %s -name *.csv | xargs rm', $tablesDestPath);
        }

        # Copy our dumps into the repo
        $this->passthru('cp -r %s %s', $tablesSrcPath, $repoPath);

        # Remove all .gitignore files in subfolders of repo
        $this->passthru('find %s ! -path %s -name .gitignore | xargs rm', $repoPath, $repoPath);

        $this->passthru('git -C %s add -A', $repoPath);

        $this->passthru(
            'git -C %s -c %s -c %s commit --author %s -m "Update CSVs"',
            $repoPath,
            'user.name=' . env('DUMP_REPO_NAME'),
            'user.email=' . env('DUMP_REPO_EMAIL'),
            env('DUMP_REPO_NAME') . ' <' . env('DUMP_REPO_EMAIL') . '>'
        );

        $this->passthru('git -C %s push %s', $repoPath, ($this->option('reset') ? '--force' : ''));

    }

    /**
     * Use this when you need to run a command interactively or show ouput.
     */
    private function passthru(string $template, string ...$args)
    {
        return $this->command($template, $args, function(string $cmd) {
            passthru($cmd, $status);
            return [
                'output' => null,
                'status' => $status,
            ];
        });
    }

    /**
     * Use this when you need to capture command output in a variable.
     */
    private function exec(string $template, string ...$args) : array
    {
        return $this->command($template, $args, function(string $cmd) {
            exec($cmd, $output, $status);
            return [
                'output' => $output,
                'status' => $status,
            ];
        });
    }

    /**
     * Sanitize and run shell command. Exit if it fails. Return output or null.
     */
    private function command(string $template, array $args, callable $callback)
    {
        $args = array_map('escapeshellarg', $args);
        $cmd = vsprintf($template, $args);

        $this->warn($cmd);

        $return = $callback($cmd);

        $this->warn('Status: ' . $return['status']);

        if ($return['status'] !== 0)
        {
            $this->warn('Something went wrong. Exiting early.');
            exit(1);
        }

        return $return['output'];
    }

    /**
     * Throw an exception if an `.env` var is empty.
     */
    private function validateEnv(array $vars)
    {
        foreach ($vars as $var)
        {
            if (empty(env($var)))
            {
                throw new Exception('Please specify `' . $var . '` in .env');
            }
        }

    }

}
