<?php

namespace Database\Factories\Dsc;

use App\Models\Dsc\Section;
use App\Models\Dsc\Publication;
use App\Models\Collections\Artwork;

class SectionFactory extends DscFactory
{
    protected $model = Section::class;

    public function definition()
    {
        return array_merge(
            $this->dscIdsAndTitle(),
            [
                'web_url' => fake()->url,
                'accession' => fake()->accession,
                'publication_id' => fake()->randomElement(Publication::query()->pluck('id')->all()),
                'artwork_id' => fake()->randomElement(Artwork::query()->pluck('id')->all()),
                'content' => fake()->paragraphs(10, true),
            ]
        );
    }
}
