<?php

namespace App\Console\Commands;

use Carbon\Carbon;

class ImportEventsFull extends AbstractImportCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:events-full';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Import all events data";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $startTime = Carbon::now();

        $this->import('events', 1);

        // TODO: Change the naming convention of the command log to match signature
        // Note that the `command` must match that of ImportEvents in order for incremental updates to work.
        $command = \App\Command::firstOrCreate(['command' => 'import-events']);
        $command->last_ran_at = $startTime;
        $command->save();

    }

    private function import($endpoint, $current = 1)
    {

        // Return false if the user bails out
        if (!$this->confirm("Running this will delete all existing events from your database! Are you sure?"))
        {
            return false;
        }

        // Remove all events from the search index
        $this->call("scout:flush", ['model' => \App\Models\Membership\Event::class]);

        // Truncate all tables
        // $this->call("migrate:refresh");

        // Pseduo-refresh this specific migration...
        $migration = new \CreateMembershipTables();
        $migration->down();
        $migration->up();

        $this->info("Refreshed CreateMembershipTables migration.");

        // Reinstall search: flush might not work, since some models might be present in the index, which aren't here
        $this->warn("Please manually ensure that your search index mappings are up-to-date.");
        // $this->call("search:uninstall");
        // $this->call("search:install");

        $class = \App\Models\Membership\Event::class;

        // Abort if the table is already filled
        $resources = call_user_func($class .'::all');
        if (!$resources->isEmpty())
        {
            return false;
        }

        // Query for the first page + get page count
        $json = $this->query($endpoint, $current);
        $pages = $json->pagination->total_pages;

        while ($current <= $pages)
        {

            foreach ($json->data as $source)
            {

                // Don't use findOrCreate here, since it causes errors due to Searchable
                $resource = call_user_func($class .'::findOrNew', $source->id);

                $resource->fillFrom($source);
                $resource->attachFrom($source);
                $resource->save();

            }

            $current++;
            $json = $this->query($endpoint, $current);

        }

        $this->info("Imported all events from data service!");

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
