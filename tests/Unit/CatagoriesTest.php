<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Category;

use Tests\Helpers\Factory;

class CategoryTest extends ApiTestCase
{

    use Factory;
    
    /** @test */
    public function it_fetches_all_categories()
    {
        $this->times(5)->make(Category::class);
        
        $response = $this->getJson('api/v1/categories');
        $response->assertSuccessful();

        $categories = $response->json()['data'];
        $this->assertCount(5, $categories);

        foreach ($categories as $category)
        {
            $this->assertArrayHasKeys($category, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_a_single_category()
    {

        $this->make(Category::class);

        $response = $this->getJson('api/v1/categories/' .$this->ids[0]);
        $response->assertSuccessful();

        $category = $response->json()['data'];
        $this->assertArrayHasKeys($category, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_multiple_categories()
    {

        $this->times(5)->make(Category::class);

        $response = $this->getJson('api/v1/categories?ids=' .implode(',',array_slice($this->ids, 0, 3)));
        $response->assertSuccessful();

        $categories = $response->json()['data'];
        $this->assertCount(3, $categories);

        foreach ($categories as $category)
        {
            $this->assertArrayHasKeys($category, ['id', 'title']);
        }
    }

    /** @test */
    public function it_404s_if_a_category_is_not_found()
    {

        $this->make(Category::class);
        
        $response = $this->getJson('api/v1/categories/' .$this->faker->unique()->randomNumber(5));

        $response->assertStatus(404);

    }

    /** @test */
    public function it_400s_if_an_alpha_id_is_passed()
    {

        $this->make(Category::class);
        
        $response = $this->getJson('api/v1/categories/fsdfdfs');

        $response->assertStatus(400);

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->make(Category::class);
        
        $response = $this->postJson('api/v1/categories');

        $response->assertStatus(405);

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->make(Category::class);
        
        $response = $this->getJson('api/v1/categories?limit=2000');

        $response->assertStatus(403);

    }


    


    protected function _getStub()
    {

        $lake_id = $this->faker->uuid;

        return [
            'citi_id' => $this->faker->unique()->randomNumber(4),
            'title' => $this->faker->words(4, true),
            'lake_guid' => $lake_id,
            'lake_uri' => 'https://lakemichigan.artic.edu/fcrepo/rest/prod/' .substr($lake_id, 0, 2) .'/' .substr($lake_id, 2, 2) .'/' .substr($lake_id, 4, 2) .'/' .substr($lake_id, 6, 2) .'/' .$lake_id,
        ];
    }
    
}
