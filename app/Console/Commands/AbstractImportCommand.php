<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

use App\Behaviors\CanQuery;

abstract class AbstractImportCommand extends BaseCommand
{

    use CanQuery {
        saveDatum as protected traitSaveDatum;
    }

    /**
     * An instance of the \App\Command model for logging.
     *
     * @var \App\Command
     */
    protected $command;


    /**
     * Here, we've extended the inherited execute method, which allows us to log times
     * for each command call. You can use `handle` in child classes as normal.
     *
     * @link http://api.symfony.com/3.3/Symfony/Component/Console/Command/Command.html
     * @link https://github.com/laravel/framework/blob/5.4/src/Illuminate/Console/Command.php
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->command = \App\Command::firstOrNew(['command' => $this->getName()]);
        $this->command->last_attempt_at = Carbon::now();
        $this->command->save();

        // Call Illuminate\Console\Command::execute
        $result = parent::execute( $input, $output );

        // If the $result is falsey (e.g. 0 or null), command was successful.
        // https://stackoverflow.com/questions/22485513/get-response-from-artisan-call
        if( !$result )
        {
            $this->command->last_success_at = $this->command->last_attempt_at;
            $this->command->save();
        }

        return $result;

    }


    protected function saveDatum( $datum, $model )
    {

        $this->info("Importing #{$datum->id}" .(property_exists($datum, 'title') ? ": {$datum->title}" : ""));

        $resource = $this->traitSaveDatum($datum, $model);

        // For debugging ids and titles:
        // $this->warn("Imported #{$resource->getKey()}: {$resource->title}");

        return $resource;

    }

}
