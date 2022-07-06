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
                'web_url' => $this->faker->url,
                'accession' => $this->faker->accession,
                'revision' => rand(1230768000, 1483228800), // timestamp b/w 2009 and 2017
                'source_id' => $this->faker->randomNumber(5),
                'weight' => $this->faker->randomNumber(2),
                'parent_id' => !rand(0, 3) ? null : $this->faker->randomElement(Section::query()->pluck('id')->all()),
                'publication_id' => $this->faker->randomElement(Publication::query()->pluck('id')->all()),
                'artwork_id' => $this->faker->randomElement(Artwork::query()->pluck('id')->all()),
                'content' => $this->faker->paragraphs(10, true),
            ]
        );
    }
}
