<?php

namespace App\Console\Commands;

use App\Models\Membership\TicketedEventType;

class ImportTicketedEventTypesFull extends AbstractImportCommand
{

    protected $signature = 'import:events-ticketed-types-full
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all ticketed event types data";


    public function handle()
    {

        $this->api = env('EVENTS_DATA_SERVICE_URL');

        if( !$this->reset() )
        {
            return false;
        }

        $this->importTicketedEventTypes();

    }

    protected function importTicketedEventTypes()
    {

        return $this->import( 'Membership', TicketedEventType::class, 'event-types' );

    }

    protected function reset()
    {

        return $this->resetData( TicketedEventType::class, 'ticketed_event_types' );

    }

    protected function save( $datum, $model, $transformer )
    {

        // TODO: Determine if this is still necessary
        $datum->source = 'galaxy';

        return parent::save( $datum, $model, $transformer );

    }

}
