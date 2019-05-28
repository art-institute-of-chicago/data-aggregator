<?php

namespace Tests\Unit;

use App\Models\Collections\Artwork;
use App\Models\Collections\Gallery;

class ArtworkTest extends ApiTestCase
{

    protected $model = Artwork::class;

    protected $keys = ['id'];

    protected $fieldsUsedByMobile = ['title',
                                     'gallery_title',
                                     'id',
                                     'main_reference_number',
                                     'artist_display',
                                     'credit_line',
                                     'date_display',
                                     'is_on_view',
                                     'date_start',
                                     'date_end',
                                     'copyright_notice',
                                     'gallery_id',
                                     'image_id',
    ];

    /** @test */
    public function it_fetches_the_gallery_for_an_artwork()
    {

        $galleryKey = $this->make(Gallery::class, ['is_closed' => false]);
        $artworkKey = $this->make(Artwork::class, ['gallery_citi_id' => $galleryKey, 'is_on_view' => true]);

        $response = $this->getJson('api/v1/artworks/' .$artworkKey);
        $response->assertSuccessful();

        $resource = $response->json()['data'];
        $this->assertTrue($resource['is_on_view']);

    }

}
