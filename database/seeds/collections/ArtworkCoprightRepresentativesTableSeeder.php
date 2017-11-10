<?php

use Illuminate\Database\Seeder;

class ArtworkCopyrightRepresentativesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $artworks = App\Models\Collections\Artwork::fake()->get();

        foreach ($artworks as $artwork) {

            $this->seedCopyrightRepresentatives( $artwork );

        }

    }

    public function seedCopyrightRepresentatives( $artwork )
    {

        $agentIds = App\Models\Collections\CopyrightRepresentative::fake()->pluck('citi_id')->all();

        $ids = [];

        for ($i = 0; $i < rand(2,4); $i++) {

            $id = $agentIds[array_rand($agentIds)];

            if (!in_array($id, $ids)) {
                $ids[] = $id;
            }

        }

        $artwork->copyrightRepresentatives()->sync($ids, false);

    }


}
