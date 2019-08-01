<?php

use App\Models\Membership\TicketedEvent;

class TicketedEventsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(TicketedEvent::class, 25)->create();
    }

}
