<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractImportCommand extends Command
{

    /**
     * An instance of the \App\Command model for logging.
     *
     * @var \App\Command
     */
    protected $command;

    /**
     * A Faker Generator for filler data.
     *
     * @var \Faker\Generator
     */
    protected $faker;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->faker = \Faker\Factory::create();

        parent::__construct();

    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    abstract public function handle();


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


    /**
     * Save a new model instance given an object retrieved from an external source.
     *
     * @param object  $datum
     * @param string  $model
     * @param boolean $fake  Whether or not to fill missing fields w/ fake data.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function saveDatum( $datum, $model )
    {

        $this->warn("Importing #{$datum->id}: {$datum->title}");

        // Don't use findOrCreate here, since it can cause errors due to Searchable
        $resource = $model::findOrNew( $datum->id );

        $resource->fillFrom($datum);
        $resource->attachFrom($datum);
        $resource->save();

        return $resource;

    }


    /**
     * Convenience curl wrapper. Accepts `GET` URL. Returns decoded JSON.
     *
     * @param string $url
     *
     * @return string
     */
    protected function query($url)
    {

        $ch = curl_init();

        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_HEADER, 0);

        ob_start();

        curl_exec ($ch);
        curl_close ($ch);
        $string = ob_get_contents();

        ob_end_clean();

        return json_decode($string);

    }

}
