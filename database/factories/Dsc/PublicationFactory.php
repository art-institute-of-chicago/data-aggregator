<?php

namespace Database\Factories\Dsc;

class PublicationFactory extends DscFactory
{
    protected $model = \App\Models\Dsc\Publication::class;

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
