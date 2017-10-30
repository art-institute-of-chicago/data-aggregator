<?php

use Illuminate\Database\Seeder;

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

        App\Models\Membership\Event::fake()->delete();

    }

}