<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Gallery;

use Tests\Helpers\Factory;

class GalleryTest extends ApiTestCase
{

    use Factory;
    
    /** @test */
    public function it_fetches_all_galleries()
    {

        $this->it_fetches_all(Gallery::class, 'galleries');
        
    }

    /** @test */
    public function it_fetches_a_single_gallery()
    {

        $this->it_fetches_a_single(Gallery::class, 'galleries');

    }

    /** @test */
    public function it_fetches_multiple_galleries()
    {

        $this->it_fetches_mutliple(Gallery::class, 'galleries');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Gallery::class, 'galleries');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Gallery::class, 'galleries');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Gallery::class, 'galleries');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Gallery::class, 'galleries');
        
    }


    /** @test */
    public function it_fetches_location_types_for_a_gallery()
    {

        $this->make(Gallery::class);
        $this->times(4)->make(LocationType::class, ['gallery_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/galleries/' .$this->ids[0] .'/location-types');
        $response->assertSuccessful();

        $types = $response->json()['data'];
        $this->assertCount(4, $types);
        
        foreach ($types as $type)
        {
            $this->assertArrayHasKeys($type, ['id', 'title']);
        }
    }

    


    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'citi_id' => $this->faker->unique()->randomNumber(5),
            'title' => $this->faker->randomElement(['Gallery ' .$this->faker->unique()->randomNumber(3), $this->faker->lastName .' ' .$this->faker->randomElement(['Hall', 'Building', 'Memorial Garden', 'Reading Room', 'Study Room'])]),
            'lake_guid' => $lake_id,
            'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
