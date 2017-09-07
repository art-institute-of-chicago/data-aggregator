<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

class ImportEvents extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Import events data that has been updated since the last import";

    /**
     * An instance of the \App\Command model for logging.
     *
     * @var \App\Command
     */
    protected $command;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $startTime = Carbon::now();
        $this->command = \App\Command::firstOrCreate(['command' => 'import-events']);
        $this->command->last_ran_at = new Carbon($this->command->last_ran_at) ?: Carbon::now();

        // For debugging...
        // $this->command->last_ran_at = $this->command->last_ran_at->subDays(10);

        $this->info("Looking for events since " . $this->command->last_ran_at);

        $this->import('events');

        $this->command->last_ran_at = $startTime;
        $this->command->save();

    }

    private function import($endpoint, $current = 1)
    {

        $class = \App\Models\Membership\Event::class;

        $json = $this->query($endpoint, $current);
        $pages = $json->pagination->total_pages;

        while ($current <= $pages)
        {

            foreach ($json->data as $source)
            {
                $sourceTime = new Carbon($source->modified_at);
                $sourceTime->timezone = config('app.timezone');

                if ($this->command->last_ran_at->lte($sourceTime))
                {

                    // Don't use findOrCreate here, since it causes errors due to Searchable
                    $resource = call_user_func($class .'::findOrNew', $source->id);

                    $resource->fillFrom($source);
                    $resource->attachFrom($source);
                    $resource->save();

                    $this->warn("Importing #" . $resource->membership_id . ": " . $resource->title);

                }
                else
                {

                    break 2;

                }

            }

            $current++;
            $json = $this->query($endpoint, $current);

        }

        $this->info("Ran out of events to import!");

    }

    private function query($type = 'events', $page = 1)
    {

        $ch = curl_init();

        curl_setopt ($ch, CURLOPT_URL, env('EVENTS_DATA_SERVICE_URL', 'http://localhost') .'/' .$type .'?page=' .$page .'&limit=100');
        curl_setopt ($ch, CURLOPT_HEADER, 0);

        ob_start();

        curl_exec ($ch);
        curl_close ($ch);
        $string = ob_get_contents();

        ob_end_clean();

        return json_decode($string);

    }

}
