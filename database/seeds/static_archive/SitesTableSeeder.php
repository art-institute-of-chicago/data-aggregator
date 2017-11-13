<?php

use App\Models\StaticArchive\Site;
use App\Models\Collections\Artwork;
use App\Models\Collections\Exhibition;

class SitesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Site::class, 25 )->create();

        $sites = Site::fake()->get();
        $artworkIds = Artwork::fake()->pluck('citi_id')->all();
        $exhibitionIds = Exhibition::fake()->pluck('citi_id')->all();

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
