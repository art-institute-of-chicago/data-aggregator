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

        factory(App\Mobile\Sound::class, 100)->create();

        $this->_addSoundsToArtworks();

    }

    private function _addSoundsToArtworks()
    {
    
        $artworks = App\Collections\Artwork::all()->all();
        $soundIds = App\Mobile\Sound::all()->pluck('mobile_id')->all();

        foreach ($artworks as $artwork) {

            $ids = [];

            for ($i = 0; $i < rand(2,8); $i++) {

                $id = $soundIds[array_rand($soundIds)];

                if (!in_array($id, $ids)) {
                    $artwork->mobileSounds()->attach($id);
                    $ids[] = $id;
                }
                
            }
            
        }

    }

}
