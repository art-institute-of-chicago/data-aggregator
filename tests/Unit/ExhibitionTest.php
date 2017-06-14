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

        $this->it_fetches_all(Exhibition::class, 'exhibitions');
        
    }

    /** @test */
    public function it_fetches_a_single_exhibition()
    {

        $this->it_fetches_a_single(Exhibition::class, 'exhibitions');

    }

    /** @test */
    public function it_fetches_multiple_exhibitions()
    {

        $this->it_fetches_mutliple(Exhibition::class, 'exhibitions');

    }


    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Exhibition::class, 'exhibitions');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Exhibition::class, 'exhibitions');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Exhibition::class, 'exhibitions');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Exhibition::class, 'exhibitions');
        
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

    


    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'citi_id' => $this->faker->unique()->randomNumber(5),
            'title' => $this->faker->firstName .' ' .$this->faker->lastName .': ' .$this->faker->words(4, true),
            'lake_guid' => $lake_id,
            'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
