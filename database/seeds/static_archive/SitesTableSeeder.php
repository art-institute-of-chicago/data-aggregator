<?php

use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\StaticArchive\Site::class, 50)->create();

        $sites = App\StaticArchive\Site::all()->all();
        $artworkIds = App\Collections\Artwork::all()->pluck('citi_id')->all();
        $exhibitionIds = App\Collections\Exhibition::all()->pluck('citi_id')->all();

        foreach ($sites as $site) {

            for ($i = 0; $i < rand(2,8); $i++) {

                $artworkId = $artworkIds[array_rand($artworkIds)];

                $site->artworks()->attach($artworkId);

            }

            $exhibitionId = $exhibitionIds[array_rand($exhibitionIds)];

            $site->exhibition_id = $exhibitionId;

        }

    }

}
