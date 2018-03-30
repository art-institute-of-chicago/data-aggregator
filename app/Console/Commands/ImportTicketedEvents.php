<?php

namespace App\Console\Commands;

use App\Models\Membership\TicketedEvent;

class ImportTicketedEvents extends AbstractImportCommandNew
{

    protected $signature = 'import:events-ticketed';

    protected $description = "Import events data that has been updated since the last import";


    protected $isPartial = true;


    public function handle()
    {

        $this->api = env('EVENTS_DATA_SERVICE_URL');

        // For debugging...
        // $this->command->last_success_at = $this->command->last_success_at->subDays(10);

        $this->info("Looking for events since " . $this->command->last_success_at);

        $this->import( TicketedEvent::class, 'events' );

        $this->info("Ran out of events to import!");

    }


    protected function save( $datum, $model )
    {

        // TODO: Determine if this is still necessary
        $datum->source = 'galaxy';

        return parent::save( $datum, $model );

    }

}
