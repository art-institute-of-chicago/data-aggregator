<?php

namespace App\Console\Commands;

use Carbon\Carbon;

class ImportEvents extends AbstractImportCommand
{

    protected $signature = 'import:events';

    protected $description = "Import events data that has been updated since the last import";


    public function handle()
    {

        // For debugging...
        // $this->command->last_success_at = $this->command->last_success_at->subDays(10);

        $this->info("Looking for events since " . $this->command->last_success_at);

        $this->import('events');

    }

    private function import($endpoint, $current = 1)
    {

        $class = \App\Models\Membership\Event::class;

        $json = $this->queryService($endpoint, $current);
        $pages = $json->pagination->total_pages;

        while ($current <= $pages)
        {

            foreach ($json->data as $source)
            {
                $sourceTime = new Carbon($source->modified_at);
                $sourceTime->timezone = config('app.timezone');

                if ($this->command->last_success_at->lte($sourceTime))
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
            $json = $this->queryService($endpoint, $current);

        }

        $this->info("Ran out of events to import!");

    }

    private function queryService($endpoint, $page = 1, $limit = 100 )
    {
        return $this->query( env('EVENTS_DATA_SERVICE_URL', 'http://localhost') . '/' . $endpoint . '?page=' . $page . '&limit=' . $limit );
    }

}
