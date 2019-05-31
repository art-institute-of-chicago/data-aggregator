<?php

namespace App\Library;

class Shell
{
    private $options = [
        'is_silent' => false,
        'non_zero_exit' => true,
    ];

    public function __construct(array $options = [])
    {
        $this->options = array_merge($this->options, array_intersect_key($options, $this->options));
    }

    /**
     * Use this when you need to run a command interactively or show ouput.
     */
    public function passthru(string $template, string ...$args)
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
    public function exec(string $template, string ...$args) : array
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

        $this->dump($cmd);

        $return = $callback($cmd);

        $this->dump('Status: ' . $return['status']);

        if ($this->options['non_zero_exit'] && $return['status'] !== 0)
        {
            throw new \Exception('Non-zero status', $return['status']);
        }

        return $return;
    }

    private function dump(string $output)
    {
        $this->options['is_silent'] || dump($output);
    }
}
