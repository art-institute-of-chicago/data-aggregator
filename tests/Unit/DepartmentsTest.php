<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Collections\Department;

use Tests\Helpers\Factory;

class DepartmentTest extends ApiTestCase
{

    use Factory;
    
    /** @test */
    public function it_fetches_all_departments()
    {
        $this->times(5)->make(Department::class);
        
        $response = $this->getJson('api/v1/departments');
        $response->assertSuccessful();

        $departments = $response->json()['data'];
        $this->assertCount(5, $departments);

        foreach ($departments as $department)
        {
            $this->assertArrayHasKeys($department, ['id', 'title']);
        }
    }

    /** @test */
    public function it_fetches_a_single_department()
    {

        $this->make(Department::class);

        $response = $this->getJson('api/v1/departments/' .$this->ids[0]);
        $response->assertSuccessful();

        $department = $response->json()['data'];
        $this->assertArrayHasKeys($department, ['id', 'title']);
    }

    /** @test */
    public function it_fetches_multiple_departments()
    {

        $this->times(5)->make(Department::class);

        $response = $this->getJson('api/v1/departments?ids=' .implode(',',array_slice($this->ids, 0, 3)));
        $response->assertSuccessful();

        $departments = $response->json()['data'];
        $this->assertCount(3, $departments);

        foreach ($departments as $department)
        {
            $this->assertArrayHasKeys($department, ['id', 'title']);
        }
    }

    /** @test */
    public function it_404s_if_a_department_is_not_found()
    {

        $this->make(Department::class);
        
        $response = $this->getJson('api/v1/departments/' .$this->faker->unique()->randomNumber(5));

        $response->assertStatus(404);

    }

    /** @test */
    public function it_400s_if_an_alpha_id_is_passed()
    {

        $this->make(Department::class);
        
        $response = $this->getJson('api/v1/departments/fsdfdfs');

        $response->assertStatus(400);

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->make(Department::class);
        
        $response = $this->postJson('api/v1/departments');

        $response->assertStatus(405);

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->make(Department::class);
        
        $response = $this->getJson('api/v1/departments?limit=2000');

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
