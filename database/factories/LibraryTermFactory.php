<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LibraryTermFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = 'zz' . $this->faker->unique()->randomNumber(8);
        return [
            'id' => $id,
            'uri' => 'http://fake.loc.fake/authorities/fake/' . $id,
            'title' => ucfirst($this->faker->words(3, true)),
        ];
    }
}
