<?php

namespace App\Console\Commands\Import;

use App\Models\Membership\TicketedEvent;

class ImportTicketedEventsFull extends AbstractImportCommand
{

    protected $signature = 'import:events-ticketed-full
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all ticketed events data";


    public function handle()
    {

        $this->api = env('EVENTS_DATA_SERVICE_URL');

        if( !$this->reset() )
        {
            return false;
        }

        $this->importTicketedEvents();

    }

    protected function importTicketedEvents()
    {

        return $this->import( 'Membership', TicketedEvent::class, 'events' );

    }

    protected function reset()
    {

        return $this->resetData( TicketedEvent::class, 'ticketed_events' );

    }

    protected function save($datum, $model, $transformer)
    {

        // TODO: Determine if this is still necessary
        $datum->source = 'galaxy';

        return parent::save( $datum, $model, $transformer );

    }

}
