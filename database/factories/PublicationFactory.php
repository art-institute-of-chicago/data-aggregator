<?php

namespace Database\Factories;

class PublicationFactory extends DscFactory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return array_merge(
            $this->dscIdsAndTitle(),
            [

                'web_url' => $this->faker->url,
                'site' => implode('', $this->faker->words(2)),
                'alias' => implode('', $this->faker->words(2)),

            ]
        );
    }
}
