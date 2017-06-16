<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Artwork;
use App\Collections\ArtworkDate;
use App\Collections\Image;
use App\Collections\Category;
use App\Collections\Artist;
use App\Collections\Department;

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

        $this->it_fetches_multiple(Artwork::class, 'artworks');

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

        $artworkKey = $this->attach(Image::class, 4)->make(Artwork::class);

        $response = $this->getJson('api/v1/artworks/' .$artworkKey .'/images');
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

        $artworkKey = $this->attach(Category::class, 4)->make(Artwork::class);

        $response = $this->getJson('api/v1/artworks/' .$artworkKey .'/categories');
        $response->assertSuccessful();
        
        $pubcats = $response->json()['data'];
        $this->assertCount(4, $pubcats);
        
        foreach ($pubcats as $pubcat)
        {
            $this->assertArrayHasKeys($pubcat, ['id', 'title', 'parent_id']);
        }
    }

    public function it_fetches_resources_for_an_artwork()
    {

        $artworkKey = $this->attach([Sound::class, Video::class, Text::class, Link::class], 4)->make(Artwork::class);
        
        $response = $this->getJson('api/v1/artworks/' .$artworkKey .'/resources');
        $response->assertSuccessful();

        $resources = $response->json()['data'];
        $this->assertCount(16, $resources);
        
        foreach ($resources as $resource)
        {
            $this->assertArrayHasKeys($resource, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_the_artist_for_an_artwork()
    {

        $artworkKey = $this->attach(Artist::class, 1, 'artist')->make(Artwork::class);

        $response = $this->getJson('api/v1/artworks/' .$artworkKey .'/artist');
        $response->assertSuccessful();

        $artist = $response->json()['data'];
        $this->assertArrayHasKeys($artist, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_the_department_for_an_artwork()
    {

        $artworkKey = $this->attach(Department::class, 1, 'department')->make(Artwork::class);

        $response = $this->getJson('api/v1/artworks/' .$artworkKey .'/department');

        $response->assertSuccessful();

        $department = $response->json()['data'];
        $this->assertArrayHasKeys($department, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_dates_for_an_artwork()
    {

        $artworkKey = $this->attach(ArtworkDate::class, 4, 'dates')->make(Artwork::class);
        
        $response = $this->getJson('api/v1/artworks/' .$artworkKey);
        $response->assertSuccessful();

        $artwork = $response->json()['data'];
        $this->assertNotEmpty($artwork->dates);

    }

}
