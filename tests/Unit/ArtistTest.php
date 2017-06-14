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

        $this->it_fetches_all(Artist::class, 'artists');
        
    }

    /** @test */
    public function it_fetches_a_single_artist()
    {

        $this->it_fetches_a_single(Artist::class, 'artists');

    }

    /** @test */
    public function it_fetches_multiple_artists()
    {

        $this->it_fetches_mutliple(Artist::class, 'artists');

    }

    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Artist::class, 'artists');
        
    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Artist::class, 'artists');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Artist::class, 'artists');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Artist::class, 'artists');
        
    }

    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'citi_id' => $this->faker->unique()->randomNumber(5),
            'title' => ucwords($this->faker->lastName .', ' .$this->faker->firstName),
            'lake_guid' => $lake_id,
            'lake_uri' => env('LAKE_URL', 'https://localhost') .'/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
