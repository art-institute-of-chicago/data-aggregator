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

        factory(App\Models\StaticArchive\Site::class, 25)->create();

        $sites = App\Models\StaticArchive\Site::fake()->get();
        $artworkIds = App\Models\Collections\Artwork::fake()->pluck('citi_id')->all();
        $exhibitionIds = App\Models\Collections\Exhibition::fake()->pluck('citi_id')->all();

        foreach ($sites as $site) {

            for ($i = 0; $i < rand(2,4); $i++) {

                $artworkId = $artworkIds[array_rand($artworkIds)];

                $site->artworks()->attach($artworkId);

            }

            $exhibitionId = $exhibitionIds[array_rand($exhibitionIds)];

            $site->exhibition_id = $exhibitionId;

        }

    }

}
