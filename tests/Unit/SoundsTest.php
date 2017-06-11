<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Sound;

use Tests\Helpers\Factory;

class SoundTest extends ApiTestCase
{

    use Factory;
    
    /** @test */
    public function it_fetches_all_sounds()
    {
        $this->times(5)->make(Sound::class);
        
        $response = $this->getJson('api/v1/sounds');
        $response->assertSuccessful();

        $sounds = $response->json()['data'];
        $this->assertCount(5, $sounds);

        foreach ($sounds as $sound)
        {
            $this->assertArrayHasKeys($sound, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_a_single_sound()
    {

        $this->make(Sound::class);

        $response = $this->getJson('api/v1/sounds/' .$this->ids[0]);
        $response->assertSuccessful();

        $sound = $response->json()['data'];
        $this->assertArrayHasKeys($sound, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_multiple_sounds()
    {

        $this->times(5)->make(Sound::class);

        $response = $this->getJson('api/v1/sounds?ids=' .implode(',',array_slice($this->ids, 0, 3)));
        $response->assertSuccessful();

        $sounds = $response->json()['data'];
        $this->assertCount(3, $sounds);

        foreach ($sounds as $sound)
        {
            $this->assertArrayHasKeys($sound, ['id', 'title']);
        }
    }

    /** @test */
    public function it_404s_if_a_sound_is_not_found()
    {

        $this->make(Sound::class);
        
        $response = $this->getJson('api/v1/sounds/' .$this->faker->unique()->randomNumber(5));

        $response->assertStatus(404);

    }

    /** @test */
    public function it_400s_if_an_alpha_id_is_passed()
    {

        $this->make(Sound::class);
        
        $response = $this->getJson('api/v1/sounds/fsdfdfs');

        $response->assertStatus(400);

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->make(Sound::class);
        
        $response = $this->postJson('api/v1/sounds');

        $response->assertStatus(405);

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->make(Sound::class);
        
        $response = $this->getJson('api/v1/sounds?limit=2000');

        $response->assertStatus(403);

    }


    


    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'citi_id' => $this->faker->unique()->randomNumber(4),
            'title' => $this->faker->words(4, true),
            'lake_guid' => $lake_id,
            'lake_uri' => env(LAKE_URL, 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
