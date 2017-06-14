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

    /** @test */
    public function it_fetches_all_images()
    {

        $this->it_fetches_all(Image::class, 'images');
        
    }

    /** @test */
    public function it_fetches_a_single_image()
    {

        $this->it_fetches_a_single(Image::class, 'images');

    }

    /** @test */
    public function it_fetches_multiple_images()
    {

        $this->it_fetches_mutliple(Image::class, 'images');

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
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Image::class, 'images');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Image::class, 'images');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Image::class, 'images');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Image::class, 'images');
        
    }


    


    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'title' => $this->faker->words(4, true),
            'lake_guid' => $lake_id,
            'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
