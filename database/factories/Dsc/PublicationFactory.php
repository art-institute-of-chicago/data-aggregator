<?php

namespace Database\Factories\Dsc;

use App\Models\Dsc\Publication;

class PublicationFactory extends DscFactory
{
    protected $model = Publication::class;

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
