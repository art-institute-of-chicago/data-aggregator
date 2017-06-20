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

        $artworks = App\Collections\Artwork::all()->all();
        $agentIds = App\Collections\CopyrightRepresentative::all()->pluck('citi_id')->all();

        foreach ($artworks as $artwork) {

            $ids = [];
            
            for ($i = 0; $i < rand(2,8); $i++) {

                $id = $agentIds[array_rand($agentIds)];

                if (!in_array($id, $ids)) {
                    $artwork->artists()->attach($id);
                    $ids[] = $id;
                }
                
            }

        }
        
    }
    
}
