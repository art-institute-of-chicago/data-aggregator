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
    public function it_fetches_artworks()
    {
        $this->_make(Artwork::class);
        
        $response = $this->getJson('api/v1/artworks');
        
        $response->assertSuccessful();
    }

    /** @test */
    public function it_fetches_a_single_artwork()
    {

        $this->_make(Artwork::class);

        $response = $this->getJson('api/v1/artworks/' .$this->ids[0]);
        $response->assertSuccessful();

        $artwork = $response->json()['data'];
        $this->assertArrayHasKeys($artwork, ['id', 'title', 'main_reference_number']);
    }

    /** @test */
    public function it_404s_if_an_artwork_is_not_found()
    {

        $this->_make(Artwork::class);
        
        $response = $this->getJson('api/v1/artworks/' .$this->faker->unique()->randomNumber(6));

        $response->assertStatus(404);

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
