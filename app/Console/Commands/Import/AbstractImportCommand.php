<?php

namespace App\Console\Commands\Import;

use Carbon\Carbon;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

use App\Behaviors\ImportsData;

use Illuminate\Support\Str;

abstract class AbstractImportCommand extends BaseCommand
{

    use ImportsData;

    /**
     * An instance of the \App\Command model for logging.
     *
     * @var \App\Command
     */
    protected $command;

    /**
     * How far back in time to scan for records.
     *
     * @var \Carbon\Carbon
     */
    protected $since;

    /**
     * Here, we've extended the inherited execute method, which allows us to log times
     * for each command call. You can use `handle` in child classes as normal.
     *
     * @link http://api.symfony.com/3.3/Symfony/Component/Console/Command/Command.html
     * @link https://github.com/laravel/framework/blob/5.4/src/Illuminate/Console/Command.php
     *
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Not an ideal solution, but some models are really heavy
        ini_set('memory_limit', '-1');

        $name = $this->getName();

        // Make `-full` commands share last-update time w/ their partial versions
        $name = Str::endsWith($name, '-full') ? substr($name, 0, -5) : $name;

        // TODO: Track import success on a per-resource basis, rather than per-command?
        $this->command = \App\Command::firstOrNew(['command' => $name]);
        $this->command->last_attempt_at = Carbon::now();
        $this->command->save();

        // Get records `--since=` or since last successful run
        $this->since = $this->command->last_success_at;

        if ($this->hasOption('since') && !empty($this->option('since'))) {
            try {
                $this->since = Carbon::parse($this->option('since'));
            } catch (\Exception $e) {
                echo 'Cannot parse date in --since option';
            }
        }

        // Call Illuminate\Console\Command::execute
        $result = parent::execute($input, $output);

        // If the $result is falsey (e.g. 0 or null), command was successful.
        // https://stackoverflow.com/questions/22485513/get-response-from-artisan-call
        if (!$result) {
            $this->command->last_success_at = $this->command->last_attempt_at;
            $this->command->save();
        }

        return $result;
    }
}
