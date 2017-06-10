<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Image;

use Tests\Helpers\Factory;

class ImageTest extends ApiTestCase
{

    use Factory;

    protected $titles = [];
    
    /** @test */
    public function it_fetches_all_images()
    {
        $this->times(5)->make(Image::class);
        
        $response = $this->getJson('api/v1/images');
        $response->assertSuccessful();

        $images = $response->json()['data'];
        $this->assertCount(5, $images);

        foreach ($images as $image)
        {
            $this->assertArrayHasKeys($image, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_a_single_image()
    {

        $this->make(Image::class);

        $response = $this->getJson('api/v1/images/' .$this->ids[0]);
        $response->assertSuccessful();

        $image = $response->json()['data'];
        $this->assertArrayHasKeys($image, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_multiple_images()
    {

        $this->times(5)->make(Image::class);

        $response = $this->getJson('api/v1/images?ids=' .implode(',',array_slice($this->ids, 0, 3)));
        $response->assertSuccessful();

        $images = $response->json()['data'];
        $this->assertCount(3, $images);

        foreach ($images as $image)
        {
            $this->assertArrayHasKeys($image, ['id', 'title']);
        }
    }

    /** @test */
    public function it_searches_for_images()
    {

        $this->times(5)->make(Image::class);

        $word_from_title = explode(' ', Image::all()->pluck('title')->first())[0];
        
        $response = $this->getJson('api/v1/images?q=' .$word_from_title);
        $response->assertSuccessful();

        $images = $response->json()['data'];
        $this->assertCount(1, $images);

        $this->assertArrayHasKeys($images[0], ['id', 'title']);

    }

    /** @test */
    public function it_deletes_a_single_image()
    {

        $this->make(Image::class);

        $response = $this->deleteJson('api/v1/images/' .$this->ids[0]);
        $response->assertSuccessful();

    }

    /** @test */
    public function it_deletes_multiple_images()
    {

        $this->times(5)->make(Image::class);

        $response = $this->deleteJson('api/v1/images?ids=' .implode(',',array_slice($this->ids, 0, 3)));
        $response->assertSuccessful();

    }

    /** @test */
    public function it_overwrites_an_existing_image()
    {

        $this->make(Image::class);

        $response = $this->putJson('api/v1/images/' .$this->ids[0]);
        $response->assertSuccessful();

    }

    /** @test */
    public function it_adds_a_new_image()
    {

        $this->make(Image::class);

        $response = $this->postJson('api/v1/images');
        $response->assertSuccessful();

    }


    /** @test */
    public function it_404s_if_an_image_is_not_found()
    {

        $this->make(Image::class);
        
        $response = $this->getJson('api/v1/images/' .$this->faker->unique()->randomNumber(5));

        $response->assertStatus(404);

    }

    /** @test */
    public function it_400s_if_an_alpha_id_is_passed()
    {

        $this->make(Image::class);
        
        $response = $this->getJson('api/v1/images/fsdfdfs');

        $response->assertStatus(400);

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->make(Image::class);
        
        $response = $this->postJson('api/v1/images');

        $response->assertStatus(405);

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->make(Image::class);
        
        $response = $this->getJson('api/v1/images?limit=2000');

        $response->assertStatus(403);

    }


    


    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'citi_id' => $this->faker->unique()->randomNumber(4),
            'title' => $this->faker->words(4, true),
            'lake_guid' => $lake_id,
            'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
