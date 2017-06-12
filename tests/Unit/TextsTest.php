<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Text;

use Tests\Helpers\Factory;

class TextTest extends ApiTestCase
{

    use Factory;
    
    /** @test */
    public function it_fetches_all_texts()
    {
        $this->times(5)->make(Text::class);
        
        $response = $this->getJson('api/v1/texts');
        $response->assertSuccessful();

        $texts = $response->json()['data'];
        $this->assertCount(5, $texts);

        foreach ($texts as $text)
        {
            $this->assertArrayHasKeys($text, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_a_single_text()
    {

        $this->make(Text::class);

        $response = $this->getJson('api/v1/texts/' .$this->ids[0]);
        $response->assertSuccessful();

        $text = $response->json()['data'];
        $this->assertArrayHasKeys($text, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_multiple_texts()
    {

        $this->times(5)->make(Text::class);

        $response = $this->getJson('api/v1/texts?ids=' .implode(',',array_slice($this->ids, 0, 3)));
        $response->assertSuccessful();

        $texts = $response->json()['data'];
        $this->assertCount(3, $texts);

        foreach ($texts as $text)
        {
            $this->assertArrayHasKeys($text, ['id', 'title']);
        }
    }

    /** @test */
    public function it_404s_if_a_text_is_not_found()
    {

        $this->make(Text::class);
        
        $response = $this->getJson('api/v1/texts/' .$this->faker->unique()->randomNumber(5));

        $response->assertStatus(404);

    }

    /** @test */
    public function it_400s_if_an_alpha_id_is_passed()
    {

        $this->make(Text::class);
        
        $response = $this->getJson('api/v1/texts/fsdfdfs');

        $response->assertStatus(400);

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->make(Text::class);
        
        $response = $this->postJson('api/v1/texts');

        $response->assertStatus(405);

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->make(Text::class);
        
        $response = $this->getJson('api/v1/texts?limit=2000');

        $response->assertStatus(403);

    }


    


    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'citi_id' => $this->faker->unique()->randomNumber(4),
            'title' => $this->faker->words(4, true),
            'lake_guid' => $lake_id,
            'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
