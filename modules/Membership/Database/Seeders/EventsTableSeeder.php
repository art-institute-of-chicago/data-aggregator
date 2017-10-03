<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Models\Membership\Event::class, 25)->create();

        $this->_addExhibitionsToEvents();

    }

    private function _addExhibitionsToEvents()
    {

        $events = App\Models\Membership\Event::fake()->get();
        $exhibitionIds = App\Models\Collections\Exhibition::fake()->pluck('citi_id')->all();

        foreach ($events as $event) {

            $ids = [];

            for ($i = 0; $i < rand(2,4); $i++) {

                $id = $exhibitionIds[array_rand($exhibitionIds)];

                if (!in_array($id, $ids)) {
                    $event->exhibitions()->attach($id);
                    $ids[] = $id;
                }

            }

        }

    }

}
