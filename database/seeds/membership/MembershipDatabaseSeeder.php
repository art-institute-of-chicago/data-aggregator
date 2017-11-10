<?php

use Illuminate\Database\Seeder;

use App\Models\Membership\Event;

class MembershipDatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(EventsTableSeeder::class);

    }

    public static function clean()
    {

        Event::fake()->delete();

    }

}
