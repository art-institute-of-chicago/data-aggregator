<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Artist;

use Tests\Helpers\Factory;

class ArtistTest extends ApiTestCase
{

    use Factory;
    
    /** @test */
    public function it_fetches_all_artists()
    {
        $this->times(5)->make(Artist::class);
        
        $response = $this->getJson('api/v1/artists');
        $response->assertSuccessful();

        $artists = $response->json()['data'];
        $this->assertCount(5, $artists);

        foreach ($artists as $artist)
        {
            $this->assertArrayHasKeys($artist, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_a_single_artist()
    {

        $this->make(Artist::class);

        $response = $this->getJson('api/v1/artists/' .$this->ids[0]);
        $response->assertSuccessful();

        $artist = $response->json()['data'];
        $this->assertArrayHasKeys($artist, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_multiple_artists()
    {

        $this->times(5)->make(Artist::class);

        $response = $this->getJson('api/v1/artists?ids=' .implode(',',array_slice($this->ids, 0, 3)));
        $response->assertSuccessful();

        $artists = $response->json()['data'];
        $this->assertCount(3, $artists);

        foreach ($artists as $artist)
        {
            $this->assertArrayHasKeys($artist, ['id', 'title']);
        }
    }

    /** @test */
    public function it_404s_if_an_artist_is_not_found()
    {

        $this->make(Artist::class);
        
        $response = $this->getJson('api/v1/artists/' .$this->faker->unique()->randomNumber(5));

        $response->assertStatus(404);

    }

    /** @test */
    public function it_400s_if_an_alpha_id_is_passed()
    {

        $this->make(Artist::class);
        
        $response = $this->getJson('api/v1/artists/fsdfdfs');

        $response->assertStatus(400);

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->make(Artist::class);
        
        $response = $this->postJson('api/v1/artists');

        $response->assertStatus(405);

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->make(Artist::class);
        
        $response = $this->getJson('api/v1/artists?limit=2000');

        $response->assertStatus(403);

    }


    /** @test */
    public function it_fetches_agent_types_for_an_artist()
    {

        $this->make(Artist::class);
        $this->times(4)->make(AgentType::class, ['artist_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artists/' .$this->ids[0] .'/agent-types');
        $response->assertSuccessful();

        $types = $response->json()['data'];
        $this->assertCount(4, $types);
        
        foreach ($types as $type)
        {
            $this->assertArrayHasKeys($type, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_a_single_agent_type_for_an_artist()
    {

        $this->make(Artist::class);
        $this->make(AgentType::class, ['artist_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artists/' .$this->ids[0] .'/agent-types/' .$this->ids[1]);
        $response->assertSuccessful();

        $type = $response->json()['data'];
        $this->assertArrayHasKeys($type, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_multiple_agent_types_for_an_artist()
    {

        $this->make(Artist::class);
        $this->times(5)->make(AgentType::class, ['artist_citi_uid' => $this->ids[0]]);

        $response = $this->getJson('api/v1/artists/' .$this->ids[0] .'/agent-types?ids=' .implode(',',array_slice($this->ids, 1, 3)));
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
            'title' => ucwords($this->faker->lastName .', ' .$this->faker->firstName),
            'lake_guid' => $lake_id,
            'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
