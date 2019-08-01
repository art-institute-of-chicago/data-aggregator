<?php

use App\Models\StaticArchive\Site;
use App\Models\Collections\Artwork;
use App\Models\Collections\Exhibition;
use App\Models\Collections\Agent;

class SitesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {
        factory(Site::class, 25)->create();

        $this->seedRelation(Site::class, Artwork::class, 'artworks');

        $this->seedRelation(Site::class, Exhibition::class, 'exhibitions');

        $this->seedRelation(Site::class, Agent::class, 'agents');
    }

}
