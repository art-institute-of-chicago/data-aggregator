<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\Artwork;
use App\Models\Collections\ArtworkCommittee;

class ArtworkCommitteesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $artworks = Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $this->seedCommittees( $artwork );

        }

    }

    public function seedCommittees( $artwork )
    {

        for ($i = 0; $i < rand(2,4); $i++) {

            $committee = factory( ArtworkCommittee::class )->make([
                'artwork_citi_id' => $artwork->citi_id,
            ]);

            $artwork->committees()->save($committee);

        }

    }


}
