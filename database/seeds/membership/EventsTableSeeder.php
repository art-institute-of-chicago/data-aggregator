<?php

use App\Models\Membership\Event;
use App\Models\Collections\Exhibition;

class EventsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Event::class, 25 )->create();

        $this->seedBelongsToMany( Event::class, Exhibition::class, 'exhibitions' );

    }

}
