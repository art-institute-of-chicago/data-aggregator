<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArchiveImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = $this->faker->unique()->randomNumber(6) + 999 * pow(10, 6);
        return [
            'id' => $id,
            'title' => ucfirst($this->faker->words(3, true)),
            'alternate_title' => ucfirst($this->faker->words(3, true)),
            'collection' => ucfirst($this->faker->words(3, true)) . ' Collection',
            'archive' => ucfirst($this->faker->words(3, true)) . ' Archive',
            'format' => ucfirst($this->faker->word),
            'file_format' => 'TIFF',
            'file_size' => $this->faker->randomNumber(5),
            'pixel_dimensions' => $this->faker->randomNumber(4) . ' x ' . $this->faker->randomNumber(4),
            'color' => ucfirst($this->faker->word),
            'physical_notes' => ucfirst($this->faker->word),
            'date' => $this->faker->year . ($this->faker->boolean ? '-' . $this->faker->year : ''),
            'date_view' => 'c. ' . $this->faker->year,
            'date_object' => '',
            'creator' => $this->faker->name,
            'additional_creator' => $this->faker->name,
            'main_id' => '',
            'subject_terms' => ['Chicago', 'Building--Steel frame'],
            'view' => ucfirst($this->faker->word),
            'image_notes' => ucfirst($this->faker->word),
            'file_name' => $id . '_2.jpg',
            'source_created_at' => $this->faker->date($format = 'Y-m-d'),
            'source_modified_at' => $this->faker->date($format = 'Y-m-d'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
