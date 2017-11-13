<?php

use App\Models\Membership\Event;
use App\Models\Collections\Exhibition;

class EventsTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Event::class, 25 )->create();

        $this->_addExhibitionsToEvents();

    }

    private function _addExhibitionsToEvents()
    {

        $events = Event::fake()->get();
        $exhibitionIds = Exhibition::fake()->pluck('citi_id')->all();

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
