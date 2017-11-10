<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\Exhibition;
use App\Models\Collections\Artwork;
use App\Models\Collections\CorporateBody;

class ExhibitionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory( Exhibition::class, 25 )->create();

        $exhibitions = Exhibition::fake()->get();

        foreach ($exhibitions as $exhibition) {

            $this->seedArtworks( $exhibition );

            $this->seedVenues( $exhibition );

        }

    }

    private function seedArtworks( $exhibition )
    {

        $ids = Artwork::fake()->pluck('citi_id')->random(rand(2,4))->all();

        $exhibition->artworks()->sync($ids, false);

    }

    private function seedVenues( $exhibition )
    {

        $ids = CorporateBody::fake()->pluck('citi_id')->random(rand(1,3))->all();

        $exhibition->venues()->sync($ids, false);

    }

}
