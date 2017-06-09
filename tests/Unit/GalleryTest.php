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
        $this->times(5)->make(Gallery::class);
        
        $response = $this->getJson('api/v1/galleries');
        $response->assertSuccessful();

        $galleries = $response->json()['data'];
        $this->assertCount(5, $galleries);

        foreach ($galleries as $gallery)
        {
            $this->assertArrayHasKeys($gallery, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_a_single_gallery()
    {

        $this->make(Gallery::class);

        $response = $this->getJson('api/v1/galleries/' .$this->ids[0]);
        $response->assertSuccessful();

        $gallery = $response->json()['data'];
        $this->assertArrayHasKeys($gallery, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_multiple_galleries()
    {

        $this->times(5)->make(Gallery::class);

        $response = $this->getJson('api/v1/galleries?ids=' .implode(',',array_slice($this->ids, 0, 3)));
        $response->assertSuccessful();

        $galleries = $response->json()['data'];
        $this->assertCount(3, $galleries);

        foreach ($galleries as $gallery)
        {
            $this->assertArrayHasKeys($gallery, ['id', 'title']);
        }
    }

    /** @test */
    public function it_404s_if_a_gallery_is_not_found()
    {

        $this->make(Gallery::class);
        
        $response = $this->getJson('api/v1/galleries/' .$this->faker->unique()->randomNumber(5));

        $response->assertStatus(404);

    }

    /** @test */
    public function it_400s_if_an_alpha_id_is_passed()
    {

        $this->make(Gallery::class);
        
        $response = $this->getJson('api/v1/galleries/fsdfdfs');

        $response->assertStatus(400);

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->make(Gallery::class);
        
        $response = $this->postJson('api/v1/galleries');

        $response->assertStatus(405);

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->make(Gallery::class);
        
        $response = $this->getJson('api/v1/galleries?limit=2000');

        $response->assertStatus(403);

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

    /** @test */
    public function it_fetches_a_single_location_type_for_a_gallery()
    {

        $this->make(Gallery::class);
        $this->make(LocationType::class, ['gallery_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/galleries/' .$this->ids[0] .'/location-types/' .$this->ids[1]);
        $response->assertSuccessful();

        $type = $response->json()['data'];
        $this->assertArrayHasKeys($type, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_multiple_location_types_for_a_gallery()
    {

        $this->make(Gallery::class);
        $this->times(5)->make(LocationType::class, ['gallery_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/galleries/' .$this->ids[0] .'/location-types?ids=' .implode(',',array_slice($this->ids, 1, 3)));
        $response->assertSuccessful();

        $types = $response->json()['data'];
        $this->assertCount(3, $types);
        
        foreach ($types as $type)
        {
            $this->assertArrayHasKeys($type, ['id', 'title', 'url']);
        }
    }

    


    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'citi_id' => $this->faker->unique()->randomNumber(5),
            'title' => $this->faker->randomElement(['Gallery ' .$this->faker->unique()->randomNumber(3), $this->faker->lastName .' ' .$this->faker->randomElement(['Hall', 'Building', 'Memorial Garden', 'Reading Room', 'Study Room'])]),
            'lake_guid' => $lake_id,
            'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
