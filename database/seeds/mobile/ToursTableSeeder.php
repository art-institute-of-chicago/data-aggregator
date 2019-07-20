<?php

use App\Models\Mobile\Tour;
use App\Models\Mobile\TourStop;

class ToursTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory(Tour::class, 25)->create();

        $this->addStopsToTours();

        // TODO: Add ability to seedRelation, while ensuring no nulls are left over?
        // $this->seedRelation( Tour::class, TourStop::class, 'stops' );

    }

    private function addStopsToTours()
    {

        $tours = Tour::fake()->get();

        foreach ($tours as $tour) {

            factory(TourStop::class, rand(2, 4))->create([
                'tour_mobile_id' => $tour->getKey(),
            ]);

        }

    }

}
