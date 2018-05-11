<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

use App\Behaviors\ImportsData;

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

        // Not an ideal solution, but some models are really heavy
        ini_set("memory_limit", "-1");

        $name = $this->getName();

        // Make `-full` commands share last-update time w/ their partial versions
        $name = ends_with( $name, '-full' ) ? substr( $name, 0, -5 ) : $name;

        // TODO: Track import success on a per-resource basis, rather than per-command?
        $this->command = \App\Command::firstOrNew(['command' => $name]);
        $this->command->last_attempt_at = Carbon::now();
        $this->command->save();

        // For debugging...
        // $this->command->last_success_at = $this->command->last_success_at->subDays(3);

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

    /**
     * Save a new model instance given an object retrieved from an external source.
     *
     * @param object  $datum
     * @param string  $model
     * @param string  $transformer
     * @param boolean $fake  Whether or not to fill missing fields w/ fake data.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function save( $datum, $model, $transformer )
    {

        $this->info("Importing #{$datum->id}" .(property_exists($datum, 'title') ? ": {$datum->title}" : ""));

        // Don't use findOrCreate here, since it can cause errors due to Searchable
        $resource = $model::findOrNew( $datum->id );

        $transformer = new $transformer();

        // Fill should always be called before sync
        // Syncing some relations requires `$instance->getKey()` to work (i.e. id is set)
        $fills = $transformer->fill( $resource, $datum );
        $syncs = $transformer->sync( $resource, $datum );

        $resource->save();

        // For debugging ids and titles:
        // $this->warn("Imported #{$resource->getKey()}: {$resource->title}");

        return $resource;

    }

}
