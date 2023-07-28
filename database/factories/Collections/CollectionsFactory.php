<?php

namespace Database\Factories\Collections;

use Illuminate\Database\Eloquent\Factories\Factory;

abstract class CollectionsFactory extends Factory
{
    public function idsAndTitle($title, $citiField = false, $idLength = 6)
    {
        $ret = [];

        if ($citiField) {
            $ret = [
                'id' => fake()->unique()->randomNumber($idLength),
            ];
        }

        return array_merge(
            $ret,
            [
                'title' => $title,
            ]
        );
    }

    public function dates($citiField = false)
    {
        $ret = [
            'source_updated_at' => fake()->dateTimeThisYear,
        ];

        return $ret;
    }
}
