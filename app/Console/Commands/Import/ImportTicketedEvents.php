<?php

namespace App\Console\Commands\Import;

class ImportTicketedEvents extends ImportTicketedEventsFull
{
    protected $signature = 'import:events-ticketed';

    protected $description = 'Import events data that has been updated since the last import';

    protected $isPartial = true;

    public function handle()
    {
        $this->api = config('resources.sources.membership');

        $this->importTicketedEvents();
    }
}
