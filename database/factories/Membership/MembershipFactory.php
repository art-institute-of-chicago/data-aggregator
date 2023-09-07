<?php

namespace Database\Factories\Membership;

use Illuminate\Database\Eloquent\Factories\Factory;

class MembershipFactory extends Factory
{
    public function membershipIdsAndTitle($title = ''): array
    {
        return [
            'id' => fake()->unique()->randomNumber(5),
            'title' => $title ? $title : ucfirst(fake()->words(3, true)),
        ];
    }

    public function membershipDates(): array
    {
        return [
            'source_updated_at' => fake()->dateTimeThisYear,
        ];
    }

    public function definition(): array
    {
        $has_capacity = rand(0, 1) === 1;

        return array_merge(
            $this->membershipIdsAndTitle(),
            [
                'image_url' => fake()->imageUrl,
                'start_at' => fake()->dateTimeThisYear,
                'end_at' => fake()->dateTimeThisYear,
                'resource_id' => fake()->randomNumber(2),
                'resource_title' => ucfirst(fake()->words(3, true)),
                'is_after_hours' => fake()->boolean,
                'is_private_event' => fake()->boolean,
                'is_admission_required' => fake()->boolean,
                'available' => $has_capacity ? fake()->randomDigit * 10 : null,
                'total_capacity' => $has_capacity ? fake()->randomDigit * 100 : null,
            ],
            $this->membershipDates()
        );
    }
}
