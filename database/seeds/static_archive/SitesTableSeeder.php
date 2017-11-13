<?php

use App\Models\StaticArchive\Site;
use App\Models\Collections\Artwork;
use App\Models\Collections\Exhibition;

class SitesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Site::class, 25 )->create();

        $this->seedPivot( Site::class, Artwork::class, 'artworks' );

        $sites = Site::fake()->get();
        $exhibitionIds = Exhibition::fake()->pluck('citi_id')->all();

        foreach ($sites as $site) {

            $exhibitionId = $exhibitionIds[array_rand($exhibitionIds)];

            $site->exhibition_id = $exhibitionId;

        }

    }

}
