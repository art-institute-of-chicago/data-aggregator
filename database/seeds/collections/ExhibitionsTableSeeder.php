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
        $artworkIds = App\Collections\Artwork::all()->pluck('citi_id')->all();
        $agentIds = App\Collections\CorporateBody::all()->pluck('citi_id')->all();

        foreach ($exhibitions as $exhibition) {
            
            for ($i = 0; $i < rand(2,8); $i++) {

                $artworkId = $artworkIds[array_rand($artworkIds)];

                $exhibition->artworks()->attach($artworkId);

            }

            for ($i = 0; $i < rand(1,3); $i++) {

                $agentId = $agentIds[array_rand($agentIds)];

                $exhibition->venues()->attach($agentId);

            }

        }

    }

}
