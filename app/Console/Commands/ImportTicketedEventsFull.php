<?php

namespace App\Console\Commands;

use DB;

use App\Models\Membership\TicketedEvent;

class ImportTicketedEventsFull extends AbstractImportCommandNew
{

    protected $signature = 'import:events-ticketed-full
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all ticketed events data";


    public function handle()
    {

        $this->api = env('EVENTS_DATA_SERVICE_URL');

        // Return false if the user bails out
        if (!$this->option('yes') && !$this->confirm("Running this will delete all existing ticketed events from your database! Are you sure?"))
        {
            return false;
        }

        // Remove all events from the search index
        $this->call("scout:flush", ['model' => TicketedEvent::class]);

        // Truncate tables
        DB::table('ticketed_events')->truncate();

        $this->info("Truncated ticketed event tables.");

        // Reinstall search: flush might not work, since some models might be present in the index, which aren't here
        $this->info("Please manually ensure that your search index mappings are up-to-date.");
        // $this->call("search:uninstall");
        // $this->call("search:install");

        $this->import(TicketedEvent::class, 'events');

        $this->info("Imported all events from data service!");

    }


    protected function save( $datum, $model )
    {

        // TODO: Determine if this is still necessary
        $datum->source = 'galaxy';

        return parent::save( $datum, $model );

    }

}
