<?php

namespace App\Console\Helpers;

trait InteractsWithShell
{
    /**
     * Use this when you need to run a command interactively or show ouput.
     */
    protected function passthru(string $template, string ...$args)
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
    protected function exec(string $template, string ...$args) : array
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
    protected function command(string $template, array $args, callable $callback)
    {
        $args = array_map('escapeshellarg', $args);
        $cmd = vsprintf($template, $args);

        // $this->warn($cmd);

        $return = $callback($cmd);

        // $this->warn('Status: ' . $return['status']);

        // TODO: Restore this for dump commands!
        // if ($return['status'] !== 0)
        // {
        //     throw new \Exception('Non-zero status', $return['status']);
        // }

        return $return;
    }
}
