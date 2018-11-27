<?php

namespace App\Console\Commands\Import;

use App\Models\Membership\TicketedEvent;

class ImportTicketedEvents extends ImportTicketedEventsFull
{

    protected $signature = 'import:events-ticketed';

    protected $description = "Import events data that has been updated since the last import";


    protected $isPartial = true;


    public function handle()
    {

        $this->api = env('EVENTS_DATA_SERVICE_URL');

        $this->importTicketedEvents();

    }

}
