<?php

namespace Database\Factories\StaticArchive;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\StaticArchive\Site;

class SiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Site::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'site_id' => $this->faker->unique()->randomNumber(4) + 999 * pow(10, 4),
            'title' => ucfirst($this->faker->words(3, true)),
            'description' => $this->faker->paragraph(5),
            'web_url' => $this->faker->url,
        ];
    }
}
