<?php

namespace Modules\Membership\Console;

use Carbon\Carbon;
use Modules\Membership\Models\Event;
use App\Console\Commands\AbstractImportCommand;

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

        $this->info("Ran out of events to import!");

    }

    private function import($endpoint, $current = 1)
    {

        $model = Event::class;

        $json = $this->queryService($endpoint, $current);
        $pages = $json->pagination->total_pages;

        while ($current <= $pages)
        {

            foreach ($json->data as $source)
            {
                $sourceTime = new Carbon($source->modified_at);
                $sourceTime->timezone = config('app.timezone');

                if ($this->command->last_success_at->gt($sourceTime))
                {
                    break 2;
                }

                $source->source = 'galaxy';
                $this->saveDatum( $source, $model );

            }

            $current++;
            $json = $this->queryService($endpoint, $current);

        }

    }

    private function queryService($endpoint, $page = 1, $limit = 100 )
    {
        return $this->query( env('EVENTS_DATA_SERVICE_URL', 'http://localhost') . '/' . $endpoint . '?page=' . $page . '&limit=' . $limit );
    }

}
