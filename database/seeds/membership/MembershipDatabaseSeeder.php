<?php

use App\Models\Membership\Event;

class MembershipDatabaseSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->call(EventsTableSeeder::class);

    }

    protected static function unseed()
    {

        Event::fake()->delete();

    }

}
