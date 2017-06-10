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
        $this->times(5)->make(Artwork::class);
        
        $response = $this->getJson('api/v1/artworks');
        $response->assertSuccessful();

        $artworks = $response->json()['data'];
        $this->assertCount(5, $artworks);

        foreach ($artworks as $artwork)
        {
            $this->assertArrayHasKeys($artwork, ['id', 'title', 'main_reference_number']);
        }
    }

    /** @test */
    public function it_fetches_a_single_artwork()
    {

        $this->make(Artwork::class);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0]);
        $response->assertSuccessful();

        $artwork = $response->json()['data'];
        $this->assertArrayHasKeys($artwork, ['id', 'title', 'main_reference_number']);
    }

    /** @test */
    public function it_fetches_multiple_artworks()
    {

        $this->times(5)->make(Artwork::class);

        $response = $this->getJson('api/v1/artworks?ids=' .implode(',',array_slice($this->ids, 0, 3)));
        $response->assertSuccessful();

        $artworks = $response->json()['data'];
        $this->assertCount(3, $artworks);

        foreach ($artworks as $artwork)
        {
            $this->assertArrayHasKeys($artwork, ['id', 'title', 'main_reference_number']);
        }
    }

    /** @test */
    public function it_404s_if_an_artwork_is_not_found()
    {

        $this->make(Artwork::class);
        
        $response = $this->getJson('api/v1/artworks/' .$this->faker->unique()->randomNumber(6));

        $response->assertStatus(404);

    }

    /** @test */
    public function it_400s_if_an_alpha_id_is_passed()
    {

        $this->make(Artwork::class);
        
        $response = $this->getJson('api/v1/artworks/fsdfdfs');

        $response->assertStatus(400);

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->make(Artwork::class);
        
        $response = $this->postJson('api/v1/artworks');

        $response->assertStatus(405);

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->make(Artwork::class);
        
        $response = $this->getJson('api/v1/artworks?limit=2000');

        $response->assertStatus(403);

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
    public function it_fetches_a_single_image_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->make(Image::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/images/' .$this->ids[1]);
        $response->assertSuccessful();

        $image = $response->json()['data'];
        $this->assertArrayHasKeys($image, ['id', 'title', 'url']);
    }

    /** @test */
    public function it_fetches_multiple_images_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->times(5)->make(Image::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/images?ids=' .implode(',',array_slice($this->ids, 1, 3)));
        $response->assertSuccessful();

        $images = $response->json()['data'];
        $this->assertCount(3, $images);
        
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
    public function it_fetches_a_single_category_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->make(Category::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/categories/' .$this->ids[1]);
        $response->assertSuccessful();

        $pubcat = $response->json()['data'];
        $this->assertArrayHasKeys($pubcat, ['id', 'title', 'parent_title']);
    }

    /** @test */
    public function it_fetches_multiple_categories_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->times(5)->make(Catgory::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/categories?ids=' .implode(',',array_slice($this->ids, 1, 3)));
        $response->assertSuccessful();

        $pubcats = $response->json()['data'];
        $this->assertCount(3, $pubcats);
        
        foreach ($pubcats as $pubcat)
        {
            $this->assertArrayHasKeys($pubcat, ['id', 'title', 'parent_title']);
        }
    }


    /** @test */
    public function it_fetches_interpretive_resources_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->times(4)->make(InterpretiveResource::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/interpretive-resources');
        $response->assertSuccessful();

        $intresources = $response->json()['data'];
        $this->assertCount(4, $intresources);
        
        foreach ($intresources as $intresource)
        {
            $this->assertArrayHasKeys($intresource, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_a_single_interpretive_resource_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->make(InterpretiveResource::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/interpretive-resources/' .$this->ids[1]);
        $response->assertSuccessful();

        $intresource = $response->json()['data'];
        $this->assertArrayHasKeys($intresource, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_multiple_interpretive_resources_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->times(5)->make(InterpretiveResource::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/interpretive-resources?ids=' .implode(',',array_slice($this->ids, 1, 3)));
        $response->assertSuccessful();

        $intresources = $response->json()['data'];
        $this->assertCount(3, $intresources);
        
        foreach ($intresources as $intresource)
        {
            $this->assertArrayHasKeys($intresource, ['id', 'title']);
        }
    }

    

    /** @test */
    public function it_fetches_artists_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->times(4)->make(Artist::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/artists');
        $response->assertSuccessful();

        $artists = $response->json()['data'];
        $this->assertCount(4, $artists);
        
        foreach ($artists as $artist)
        {
            $this->assertArrayHasKeys($artist, ['id', 'title', 'url']);
        }
    }

    /** @test */
    public function it_fetches_a_single_artist_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->make(Artist::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/artists/' .$this->ids[1]);
        $response->assertSuccessful();

        $artist = $response->json()['data'];
        $this->assertArrayHasKeys($artist, ['id', 'title', 'url']);
    }

    /** @test */
    public function it_fetches_multiple_artists_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->times(5)->make(Artist::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/artists?ids=' .implode(',',array_slice($this->ids, 1, 3)));
        $response->assertSuccessful();

        $artists = $response->json()['data'];
        $this->assertCount(3, $artists);
        
        foreach ($artists as $artist)
        {
            $this->assertArrayHasKeys($artist, ['id', 'title', 'url']);
        }
    }


    /** @test */
    public function it_fetches_departments_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->times(4)->make(Department::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/departments');
        $response->assertSuccessful();

        $departments = $response->json()['data'];
        $this->assertCount(4, $departments);
        
        foreach ($departments as $department)
        {
            $this->assertArrayHasKeys($department, ['id', 'title', 'url']);
        }
    }

    /** @test */
    public function it_fetches_a_single_department_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->make(Department::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/departments/' .$this->ids[1]);
        $response->assertSuccessful();

        $department = $response->json()['data'];
        $this->assertArrayHasKeys($department, ['id', 'title', 'url']);
    }

    /** @test */
    public function it_fetches_multiple_departments_for_an_artwork()
    {

        $this->make(Artwork::class);
        $this->times(5)->make(Department::class, ['artwork_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0] .'/departments?ids=' .implode(',',array_slice($this->ids, 1, 3)));
        $response->assertSuccessful();

        $departments = $response->json()['data'];
        $this->assertCount(3, $departments);
        
        foreach ($departments as $department)
        {
            $this->assertArrayHasKeys($department, ['id', 'title', 'url']);
        }
    }

    


    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'citi_id' => $this->faker->unique()->randomNumber(6),
            'title' => ucwords($this->faker->words(4, true)),
            'lake_guid' => $lake_id,
            'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
