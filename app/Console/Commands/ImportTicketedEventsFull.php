<?php

namespace App\Console\Commands;

use App\Models\Membership\TicketedEvent;

class ImportTicketedEventsFull extends AbstractImportCommandNew
{

    protected $signature = 'import:events-ticketed-full
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all ticketed events data";


    public function handle()
    {

        $this->api = env('EVENTS_DATA_SERVICE_URL');

        $hasReset = $this->reset( TicketedEvent::class, 'ticketed_events' );

        if( !$hasReset )
        {
            return false;
        }

        $this->import( TicketedEvent::class, 'events' );

    }


    protected function save( $datum, $model )
    {

        // TODO: Determine if this is still necessary
        $datum->source = 'galaxy';

        return parent::save( $datum, $model );

    }

}
