<?php

use App\Models\Membership\LegacyEvent;
use App\Models\Collections\Exhibition;

class TicketedEventsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( TicketedEvent::class, 25 )->create();

    }

}
