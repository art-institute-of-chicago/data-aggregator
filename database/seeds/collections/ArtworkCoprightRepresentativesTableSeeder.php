<?php

use App\Models\Collections\Artwork;
use App\Models\Collections\CopyrightRepresentative;

class ArtworkCopyrightRepresentativesTableSeeder extends AbstractSeeder
{

    protected function seed()
    {

        $this->seedBelongsToMany( Artwork::class, CopyrightRepresentative::class, 'copyrightRepresentatives' );

    }

}
