<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Artwork;

use Tests\Helpers\Factory;

class ArtworkTest extends ApiTestCase
{

    use Factory;
    
    /** @test */
    public function it_fetches_all_artworks()
    {

        $this->it_fetches_all(Artwork::class, 'artworks');
        
    }

    /** @test */
    public function it_fetches_a_single_artwork()
    {

        $this->it_fetches_a_single(Artwork::class, 'artworks');

    }

    /** @test */
    public function it_fetches_multiple_artworks()
    {

        $this->it_fetches_mutliple(Artwork::class, 'artworks');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Artwork::class, 'artworks');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Artwork::class, 'artworks');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Artwork::class, 'artworks');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Artwork::class, 'artworks');
        
    }


    /** @test */
    public function it_fetches_images_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->times(4)->make(Image::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/images');
        $response->assertSuccessful();

        $images = $response->json()['data'];
        $this->assertCount(4, $images);
        
        foreach ($images as $image)
        {
            $this->assertArrayHasKeys($image, ['id', 'title', 'url']);
        }
    }
    
    /** @test */
    public function it_fetches_categories_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->times(4)->make(Catagory::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/categories');
        $response->assertSuccessful();

        $pubcats = $response->json()['data'];
        $this->assertCount(4, $pubcats);
        
        foreach ($pubcats as $pubcat)
        {
            $this->assertArrayHasKeys($pubcat, ['id', 'title', 'parent_title']);
        }
    }

    /** @test */
    public function it_fetches_resources_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->times(4)->make(InterpretiveResource::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/resources');
        $response->assertSuccessful();

        $intresources = $response->json()['data'];
        $this->assertCount(4, $intresources);
        
        foreach ($intresources as $intresource)
        {
            $this->assertArrayHasKeys($intresource, ['id', 'title']);
        }
    }
    

    /** @test */
    public function it_fetches_the_artist_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->make(Artist::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/artist');
        $response->assertSuccessful();

        $artist = $response->json()['data'];
        $this->assertArrayHasKeys($artist, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_the_department_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->make(Department::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/department');
        $response->assertSuccessful();

        $department = $response->json()['data'];
        $this->assertArrayHasKeys($department, ['id', 'title']);
    }

    


    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'citi_id' => $this->faker->unique()->randomNumber(6),
            'title' => ucwords($this->faker->words(4, true)),
            'lake_guid' => $lake_id,
            'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
