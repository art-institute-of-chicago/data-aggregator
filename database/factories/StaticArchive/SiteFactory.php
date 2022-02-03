<?php

namespace Database\Factories\StaticArchive;

use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    protected $model = \App\Models\StaticArchive\Site::class;

    public function definition()
    {
        return [
            'site_id' => $this->faker->unique()->randomNumber(4),
            'title' => ucfirst($this->faker->words(3, true)),
            'description' => $this->faker->paragraph(5),
            'web_url' => $this->faker->url,
        ];
    }
}
