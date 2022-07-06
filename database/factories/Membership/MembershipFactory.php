<?php

namespace Database\Factories\Membership;

use Illuminate\Database\Eloquent\Factories\Factory;

class MembershipFactory extends Factory
{

    public function membershipIdsAndTitle($title = '')
    {
        return [
            'id' => $this->faker->unique()->randomNumber(5),
            'title' => $title ? $title : ucfirst($this->faker->words(3, true)),
        ];
    }

    public function membershipDates()
    {
        return [
            'source_modified_at' => $this->faker->dateTimeThisYear,
        ];
    }

    public function definition()
    {
        $has_capacity = rand(0, 1) === 1;

        return array_merge(
            $this->membershipIdsAndTitle(),
            [
                'image_url' => $this->faker->imageUrl,
                'start_at' => $this->faker->dateTimeThisYear,
                'end_at' => $this->faker->dateTimeThisYear,
                'resource_id' => $this->faker->randomNumber(2),
                'resource_title' => ucfirst($this->faker->words(3, true)),
                'is_after_hours' => $this->faker->boolean,
                'is_private_event' => $this->faker->boolean,
                'is_admission_required' => $this->faker->boolean,
                'available' => $has_capacity ? $this->faker->randomDigit * 10 : null,
                'total_capacity' => $has_capacity ? $this->faker->randomDigit * 100 : null,
            ],
            $this->membershipDates()
        );
    }
}
