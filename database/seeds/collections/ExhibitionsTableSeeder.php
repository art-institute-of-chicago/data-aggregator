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

        factory(App\Models\Collections\Exhibition::class, 25)->create();

        $exhibitions = App\Models\Collections\Exhibition::fake()->get();

        foreach ($exhibitions as $exhibition) {

            $this->seedArtworks( $exhibition );

            $this->seedVenues( $exhibition );

        }

    }

    private function seedArtworks( $exhibition )
    {

        $ids = \App\Models\Collections\Artwork::fake()->pluck('citi_id')->random(rand(2,4))->all();

        $exhibition->artworks()->sync($ids, false);

    }

    private function seedVenues( $exhibition )
    {

        $ids = \App\Models\Collections\CorporateBody::fake()->pluck('citi_id')->random(rand(1,3))->all();

        $exhibition->venues()->sync($ids, false);

    }

}
