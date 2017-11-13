<?php

use App\Models\Mobile\Tour;
use App\Models\Mobile\TourStop;

class ToursTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory( Tour::class, 25 )->create();

        $this->_addStopsToTours();

    }

    private function _addStopsToTours()
    {

        $tours = Tour::fake()->get();

        foreach ($tours as $tour) {

            for ($i = 0; $i < rand(2,4); $i++) {

                factory( TourStop::class )->create(['tour_mobile_id' => $tour->mobile_id]);

            }

        }

    }

}
