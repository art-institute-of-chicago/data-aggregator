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
                'id' => $this->faker->unique()->randomNumber($idLength),
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
            'source_modified_at' => $this->faker->dateTimeThisYear,
        ];

        return $ret;
    }
}
