<?php

namespace Database\Factories\Web;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Web\Event;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(4) + 999 * pow(10, 4),
            'title' => ucfirst($this->faker->words(3, true)),
            'is_private' => false,
            'published' => true,
            'layout_type' => $this->faker->randomDigit,
        ];
    }
}
