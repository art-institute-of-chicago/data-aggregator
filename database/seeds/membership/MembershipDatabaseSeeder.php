<?php

use App\Models\Membership\TicketedEvent;

class MembershipDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {
        $this->call(TicketedEventsTableSeeder::class);
    }

    protected static function unseed()
    {
        TicketedEvent::query()->delete();
    }

}
