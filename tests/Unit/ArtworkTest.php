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

        // Two dimensional works
        $id = $this->make(Artwork::class, ['dimensions' => '472 x 345 mm']);
        $this->assertEquals([472,345], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => 'Approx. 24 x 18.3 cm']);
        $this->assertEquals([240,183], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '291 x 201 mm (plate trimmed)']);
        $this->assertEquals([291,201], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '184.2 x 148.9 cm (72 1/2 x 58 1/2 in.)']);
        $this->assertEquals([1842,1489], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '42 × 131.7 cm (16 3/4 × 51 7/8 in.)']);
        $this->assertEquals([420,1317], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '47.9 × 60.6 cm (18 7/8 × 23 7/8 in.)']);
        $this->assertEquals([479,606], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '30.5 × 25.4 cm (12 × 10 in.)']);
        $this->assertEquals([305,254], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '28 3/4 × 36 1/4 in. (73 × 92.1 cm)']);
        $this->assertEquals([730,921], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '48.6 x 39.3 cm (image/paper/mount)']);
        $this->assertEquals([486,393], Artwork::find($id)->dimensions());

        // Three-dimensional works
        $id = $this->make(Artwork::class, ['dimensions' => '130.5 × 43.2 × 31 cm (51 1/3 × 17 × 12 1/5 in.)']);
        $this->assertEquals([1305,432,310], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '139.7 × 61 × 66 cm (55 × 24 × 26 in.)']);
        $this->assertEquals([1397,610,660], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '15.6 × 10.4 × 5.4 cm (6 1/8 × 4 1/8 × 2 1/8 in.)']);
        $this->assertEquals([156,104,54], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '150.5 × 121 × 39 cm (59 1/16 × 47 5/8 × 15 3/8 in.)']);
        $this->assertEquals([1505,1210,390], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => 'Interior: 14 × 21 × 24 in.\nScale: 1 inch = 1 foot']);
        $this->assertEquals([355,533,609], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '3.5 × 6 × .3 cm (1 3/8 × 2 3/8 × 1/8 in.)']);
        $this->assertEquals([35,60,3], Artwork::find($id)->dimensions());

        // Complicated dimesions
        $id = $this->make(Artwork::class, ['dimensions' => '452 x 661 mm (image); 461 x 669 mm (plate); 498 x 729 mm (sheet)']);
        $this->assertEquals([452,661], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '107.6 x 27.8 cm (42 3/8 x 11 in.)
Warp repeat: 72.2 cm (28 3/8 in.)']);
        $this->assertEquals([1076,278], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => 'a (jar): 7.1 x 8.5 x 8.5 cm (2.82 x 3 .375 x 3.375 in)
b (lid): 2.1 x 4 x 4 cm (.83 x 1.61 x 1.60 in)
c (saucer): 2.5 x 13.3 x 13.3 cm (1 x 5.25 x 5.25 in)']);
        $this->assertEquals([71,85,85], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '87.5 × 69.3 cm (34 7/16 × 27 1/4 in.)\nPredella: 26.5 × 69.2 cm']);
        $this->assertEquals([875,693], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => '33.9 x 25.5 cm (image/paper); 44 x 35.2 cm (mount)']);
        $this->assertEquals([339,255], Artwork::find($id)->dimensions());

        // Some 3D works, like armor and teapots, only have the height or width entered
        $id = $this->make(Artwork::class, ['dimensions' => 'H. 5.6 cm (2 3/16 in.); diam. 10.9 cm (4 15/16 in.)']);
        $this->assertEquals([56,109], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => 'H. 127 cm (50 in.)']);
        $this->assertEquals([1270], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => 'H. 14.5 cm (5 11/16 in.)']);
        $this->assertEquals([145], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => 'W. 0.75 cm (1/4 in.); diam. 2 cm (3/4 in.)']);
        $this->assertEquals([7,20], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => 'H. 6 cm (2 3/8 in.); diam. 1.9 cm (3/4 in.)']);
        $this->assertEquals([60,19], Artwork::find($id)->dimensions());

        $id = $this->make(Artwork::class, ['dimensions' => 'Dimensions vary with installation']);
        $this->assertEquals([0,0], Artwork::find($id)->dimensions());

    }

}
