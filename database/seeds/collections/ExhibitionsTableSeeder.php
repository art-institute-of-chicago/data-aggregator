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

        factory(App\Models\Collections\Exhibition::class, 100)->create();

        $exhibitions = App\Models\Collections\Exhibition::all()->all();

        foreach ($exhibitions as $exhibition) {

            $exhibition->seedArtworks();

            $exhibition->seedVenues();

        }

    }

}
