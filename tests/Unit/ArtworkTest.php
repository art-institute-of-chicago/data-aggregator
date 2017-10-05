<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Collections\Artwork;
use App\Models\Collections\Gallery;

class ArtworkTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_fetches_the_gallery_for_an_artwork()
    {
        $galleryKey = $this->make(Gallery::class, ['is_closed' => false]);
        $artworkKey = $this->make(Artwork::class, ['gallery_citi_id' => $galleryKey, 'is_on_view' => true]);

        $response = $this->getJson('api/v1/artworks/' . $artworkKey);
        $response->assertSuccessful();

        $resource = $response->json()['data'];
        $this->assertTrue($resource['is_on_view']);
    }

    /** @test */
    public function it_parses_dimension_properly()
    {

        $id = $this->make(Artwork::class, ['dimensions' => '472 x 345 mm']);
        $this->assertEquals([472,345], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '184.2 x 148.9 cm (72 1/2 x 58 1/2 in.)']);
        $this->assertEquals([1842,1489], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '452 x 661 mm (image); 461 x 669 mm (plate); 498 x 729 mm (sheet)']);
        $this->assertEquals([452,661], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '291 x 201 mm (plate trimmed)']);
        $this->assertEquals([291,201], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => 'a (jar): 7.1 x 8.5 x 8.5 cm (2.82 x 3 .375 x 3.375 in)
b (lid): 2.1 x 4 x 4 cm (.83 x 1.61 x 1.60 in)
c (saucer): 2.5 x 13.3 x 13.3 cm (1 x 5.25 x 5.25 in)']);
        $this->assertEquals([71,85,85], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '107.6 x 27.8 cm (42 3/8 x 11 in.)
Warp repeat: 72.2 cm (28 3/8 in.)']);
        $this->assertEquals([1076,278], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => 'Approx. 24 x 18.3 cm']);
        $this->assertEquals([240,183], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => 'H. 5.6 cm (2 3/16 in.); diam. 10.9 cm (4 15/16 in.)']);
        $this->assertEquals([56,109], Artwork::find($id)->dimensions());

    }

}
