<?php

use Illuminate\Database\Seeder;

class ExhibitionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Collections\Exhibition::class, 100)->create();

        $exhibitions = App\Collections\Exhibition::all()->all();

        foreach ($exhibitions as $exhibition) {
            
            $exhibition->seedArtworks();

            $exhibition->seedVenues();

        }

    }

}
