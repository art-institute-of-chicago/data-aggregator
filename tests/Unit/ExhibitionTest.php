<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Exhibition;

use Tests\Helpers\Factory;

class ExhibitionTest extends ApiTestCase
{

    use Factory;
    
    /** @test */
    public function it_fetches_all_exhibitions()
    {
        $this->times(5)->make(Exhibition::class);
        
        $response = $this->getJson('api/v1/exhibitions');
        $response->assertSuccessful();

        $exhibitions = $response->json()['data'];
        $this->assertCount(5, $exhibitions);

        foreach ($exhibitions as $exhibition)
        {
            $this->assertArrayHasKeys($exhibition, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_a_single_exhibition()
    {

        $this->make(Exhibition::class);

        $response = $this->getJson('api/v1/exhibitions/' .$this->ids[0]);
        $response->assertSuccessful();

        $exhibition = $response->json()['data'];
        $this->assertArrayHasKeys($exhibition, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_multiple_exhibitions()
    {

        $this->times(5)->make(Exhibition::class);

        $response = $this->getJson('api/v1/exhibitions?ids=' .implode(',',array_slice($this->ids, 0, 3)));
        $response->assertSuccessful();

        $exhibitions = $response->json()['data'];
        $this->assertCount(3, $exhibitions);

        foreach ($exhibitions as $exhibition)
        {
            $this->assertArrayHasKeys($exhibition, ['id', 'title']);
        }
    }

    /** @test */
    public function it_404s_if_an_exhibition_is_not_found()
    {

        $this->make(Exhibition::class);
        
        $response = $this->getJson('api/v1/exhibitions/' .$this->faker->unique()->randomNumber(5));

        $response->assertStatus(404);

    }

    /** @test */
    public function it_400s_if_an_alpha_id_is_passed()
    {

        $this->make(Exhibition::class);
        
        $response = $this->getJson('api/v1/exhibitions/fsdfdfs');

        $response->assertStatus(400);

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->make(Exhibition::class);
        
        $response = $this->postJson('api/v1/exhibitions');

        $response->assertStatus(405);

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->make(Exhibition::class);
        
        $response = $this->getJson('api/v1/exhibitions?limit=2000');

        $response->assertStatus(403);

    }


    /** @test */
    public function it_fetches_exhibition_types_for_an_exhibition()
    {

        $this->make(Exhibition::class);
        $this->times(4)->make(ExhibitionType::class, ['exhibition_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/exhibitions/' .$this->ids[0] .'/exhibition-types');
        $response->assertSuccessful();

        $types = $response->json()['data'];
        $this->assertCount(4, $types);
        
        foreach ($types as $type)
        {
            $this->assertArrayHasKeys($type, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_a_single_exhibition_type_for_an_exhibition()
    {

        $this->make(Exhibition::class);
        $this->make(ExhibitionType::class, ['exhibition_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/exhibitions/' .$this->ids[0] .'/exhibition-types/' .$this->ids[1]);
        $response->assertSuccessful();

        $type = $response->json()['data'];
        $this->assertArrayHasKeys($type, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_multiple_exhibition_types_for_an_exhibition()
    {

        $this->make(Exhibition::class);
        $this->times(5)->make(ExhibitionType::class, ['exhibition_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/exhibitions/' .$this->ids[0] .'/exhibition-types?ids=' .implode(',',array_slice($this->ids, 1, 3)));
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
            'title' => $this->faker->firstName .' ' .$this->faker->lastName .': ' .$this->faker->words(4),
            'lake_guid' => $lake_id,
            'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
