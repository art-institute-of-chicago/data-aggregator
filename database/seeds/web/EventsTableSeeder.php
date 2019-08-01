<?php

use App\Models\Web\Event;

class EventsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(Event::class, 25)->create();
    }

}
