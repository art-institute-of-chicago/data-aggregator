<?php

use App\Models\Membership\LegacyEvent;
use App\Models\Membership\TicketedEvent;

class MembershipDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->call(LegacyEventsTableSeeder::class);
        $this->call(TicketedEventsTableSeeder::class);

    }

    protected static function unseed()
    {

        LegacyEvent::fake()->delete();
        TicketedEvent::fake()->delete();

    }

}
