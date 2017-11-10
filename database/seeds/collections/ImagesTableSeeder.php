<?php

use Illuminate\Database\Seeder;

use App\Models\Collections\Image;
use App\Models\Collections\Artwork;

class ImagesTableSeeder extends Seeder
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

            $this->seedImages( $artwork );

        }

    }

    public function seedImages( $artwork )
    {

        $hasPreferred = false;

        for ($i = 0; $i < rand(2,4); $i++) {

            $preferred = $hasPreferred ? false : app('Faker')->boolean;

            // TODO: Problem! What if the image depicts multiple artworks?
            // This architecture means it would have to be the preferred one for all of them!
            // Potentially consider specifying `preferred` column on the pivot table?
            // https://laravel.com/docs/5.4/eloquent-relationships#many-to-many

            $image = factory( Image::class )->make();
            $artwork->images()->save($image);

            if ($preferred || $hasPreferred) $hasPreferred = true;

        }

        return $this;

    }

}
