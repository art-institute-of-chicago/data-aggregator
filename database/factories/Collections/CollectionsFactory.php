<?php

namespace Database\Factories\Collections;

use Illuminate\Database\Eloquent\Factories\Factory;

abstract class CollectionsFactory extends Factory
{
    public function idsAndTitle($title, $citiField = false, $idLength = 6): array
    {
        $ret = [];

        if ($citiField) {
            $ret = [
                // Start at 1, since an id of 0 fails `validateId` and the API returns an error
                'id' => fake()->unique()->numberBetween(1, 10 ** $idLength - 1),
            ];
        }

        return array_merge(
            $ret,
            [
                'title' => $title,
            ]
        );
    }

    public function dates($citiField = false): array
    {
        $ret = [
            'source_updated_at' => fake()->dateTimeThisYear,
        ];

        return $ret;
    }
}
