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
                'web_url' => fake()->url,
            ]
        );
    }
}
