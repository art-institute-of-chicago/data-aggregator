<?php

use App\Models\Membership\LegacyEvent;
use App\Models\Collections\Exhibition;

class LegacyEventsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( LegacyEvent::class, 25 )->create();

        $this->seedRelation( Event::class, Exhibition::class, 'exhibitions' );

    }

}
