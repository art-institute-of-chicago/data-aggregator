<?php

class TicketedEventsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory(TicketedEvent::class, 25)->create();

    }

}
