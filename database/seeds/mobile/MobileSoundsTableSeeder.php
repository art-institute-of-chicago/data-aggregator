<?php

use Illuminate\Database\Seeder;

class MobileSoundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Models\Mobile\Sound::class, 25)->create();

        $this->_addSoundsToArtworks();

    }

    private function _addSoundsToArtworks()
    {

        $artworks = App\Models\Mobile\Artwork::fake()->get();
        $soundIds = App\Models\Mobile\Sound::fake()->pluck('mobile_id')->all();

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
