<?php

use App\Models\Mobile\Sound;
use App\Models\Mobile\Artwork;

class MobileSoundsTableSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected function seed()
    {

        factory( Sound::class, 25 )->create();

        $this->_addSoundsToArtworks();

    }

    private function _addSoundsToArtworks()
    {

        $artworks = Artwork::fake()->get();
        $soundIds = Sound::fake()->pluck('mobile_id')->all();

        foreach ($artworks as $artwork) {

            $ids = [];

            for ($i = 0; $i < rand(2,4); $i++) {

                $id = $soundIds[array_rand($soundIds)];

                if (!in_array($id, $ids)) {
                    $artwork->sounds()->attach($id);
                    $ids[] = $id;
                }

            }

        }

    }

}
