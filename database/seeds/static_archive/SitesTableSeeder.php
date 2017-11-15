<?php

use App\Models\StaticArchive\Site;
use App\Models\Collections\Artwork;
use App\Models\Collections\Exhibition;

class SitesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        factory( Site::class, 25 )->create();

        $this->seedRelation( Site::class, Artwork::class, 'artworks' );

        $this->seedRelation( Site::class, Exhibition::class, 'exhibition' );

    }

}
