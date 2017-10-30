<?php

use Illuminate\Database\Seeder;

class ToursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Models\Mobile\Tour::class, 25)->create();

        $this->_addStopsToTours();

    }

    private function _addStopsToTours()
    {

        $tours = App\Models\Mobile\Tour::fake()->get();

        foreach ($tours as $tour) {

            for ($i = 0; $i < rand(2,4); $i++) {

                factory(App\Models\Mobile\TourStop::class)->create(['tour_mobile_id' => $tour->mobile_id]);

            }

        }

    }

}
