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

        factory(App\Mobile\Tour::class, 100)->create();

        $this->_addStopsToTours();

    }

    private function _addStopsToTours()
    {
    
        $tours = App\Mobile\Tour::all()->all();

        foreach ($tours as $tour) {

            for ($i = 0; $i < rand(4,12); $i++) {

                factory(App\Mobile\TourStop::class)->create(['tour_mobile_id' => $tour->mobile_id]);
                
            }
            
        }

    }

}
