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

        $this->clean();

        $this->call(EventsTableSeeder::class);

    }

    private function clean()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        App\Models\Membership\Event::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

}