<?php

namespace Database\Factories\Dsc;

use App\Models\Dsc\Publication;

class PublicationFactory extends DscFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Publication::class;

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
