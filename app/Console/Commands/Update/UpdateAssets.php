<?php

namespace App\Console\Commands\Update;

use Carbon\Carbon;

use App\Models\Collections\Asset;
use App\Models\Collections\Sound;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class UpdateAssets extends BaseCommand
{

    protected $signature = 'update:assets';

    protected $description = "Seed resource designations for Nighthawk's assets";


    public function handle()
    {

        $resource_ids = [
            'multimedia' => [
                '575c532c-bea8-9b88-ccda-d9a50c1f390d',
                '45f59e53-9d9f-9d67-c168-758cc8db6633',
                '367c0218-d7a9-474d-902f-19c8132c01aa',
                '80822072-0357-2803-7e3a-7a8a4c1a3f62',

                // Paris Street; Rainy Day - YouTube URLs
                '46423041-a9f6-54b8-5e64-8106cda87e63',
                'f9a367ce-38ec-e366-2c80-f33f2ed41da1',
            ],
            'educational' => [
                '45f59e53-9d9f-9d67-c168-758cc8db6633',
                '0d3b845e-baf6-46b1-ad63-db48763ae850',
                'c22d104c-5c76-3940-8bea-b681df9baaf2',
                'a4c38cd7-e5e2-fc67-b9ae-67a1962766fa',
                '88eaaf01-afc3-22f3-5b70-77cfedeba46c',
                '77f9ab5b-d366-1d80-1d09-c42cba974b60',
                'fbe5ae4e-e5ce-2220-2494-5751032e037b',
                '7d10955e-e8b1-be5c-2c78-2e0a5a31e274',
                '5e8e0e2e-710e-0565-e639-5f1ac27de809',
                '068e6baf-6d88-0bde-b46e-794f4c7a481b',
                'bf625d58-a634-41ec-189d-88c694d157a9',
                'ee6497f2-b5d5-d0c4-97c1-3f591676a06e',
                'e2193e3c-80dd-386e-0ae3-a0d11883d367',
            ],
            'teacher' => [
                '0d3b845e-baf6-46b1-ad63-db48763ae850',
                '88eaaf01-afc3-22f3-5b70-77cfedeba46c',
                '77f9ab5b-d366-1d80-1d09-c42cba974b60',
                'fbe5ae4e-e5ce-2220-2494-5751032e037b',
                '7d10955e-e8b1-be5c-2c78-2e0a5a31e274',
                '5e8e0e2e-710e-0565-e639-5f1ac27de809',
                '068e6baf-6d88-0bde-b46e-794f4c7a481b',
                'ee6497f2-b5d5-d0c4-97c1-3f591676a06e',
            ],
        ];

        foreach( $resource_ids as $category => $ids )
        {

            foreach( $ids as $id )
            {

                // We can't just save Asset directly – it'll get sent to the wrong index!
                $asset = Asset::find( $id );

                if( !isset( $asset ) )
                {
                    continue;
                }

                $type = $asset->type;

                $field = 'is_' . $category . '_resource';
                $model = '\App\Models\Collections\\' . ucfirst( $type );

                $asset = $model::find( $id );
                $asset->$field = true;
                $asset->save();

            }

        }

        // Add SoundCloud link to Paris Street; Rainy Day
        $this->addManualSoundCloudAsset();

    }

    private function addManualSoundCloudAsset()
    {

        $id = '86178b00-4229-4295-bb06-15edef83c023';

        $sound = Sound::findOrNew( $id );
        $sound->lake_guid = $id;
        $sound->title = "Paris Street; Rainy Day, Gustave Caillebotte";

        $sound->is_multimedia_resource = true;
        $sound->is_educational_resource = false;
        $sound->is_teacher_resource = false;

        $sound->description = 'Indulge in the sunlit bank of the River Seine in Georges Seurat’s "A Sunday on La Grande Jatte" or make a late-night stop at a New York City diner in Edward Hopper’s "Nighthawks" in this tour of the museum’s iconic collection. Founded in 1879, the Art Institute of Chicago is home to a massive collection spanning nearly all of human history. As you explore centuries of art, this tour highlights some essential landmarks—with lesser known, but equally engaging artworks—along the way. The soundtrack features the music of Andrew Bird, another Chicago essential.';

        $sound->content = '<iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/326298581&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true"></iframe>';

        $sound->source_indexed_at = $sound->source_modified_at = Carbon::now();

        $sound->save();

        $sound->artworks()->sync([20684]);

    }

}
