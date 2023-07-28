<?php

namespace Database\Factories\Collections;

use App\Models\Collections\Agent;
use App\Models\Collections\AgentType;
use App\Models\Collections\ArtworkType;
use App\Models\Collections\Place;

class ArtworkFactory extends CollectionsFactory
{
    protected $model = \App\Models\Collections\Artwork::class;

    public function definition()
    {
        $date_end = fake()->year;
        $artist = Agent::where('agent_type_id', AgentType::where('title', 'Individual')->first()->id)->get()->random();
        return array_merge(
            $this->idsAndTitle(ucwords(fake()->words(4, true)), true, 6),
            [
                'main_id' => fake()->accession,
                'date_display' => '' . $date_end,
                'date_start' => fake()->year,
                'date_end' => $date_end,
                'description' => fake()->paragraph(5),
                'artist_display' => $artist->title_raw . "\n" . fake()->country . ', ' . fake()->year . '–' . fake()->year,
                'dimensions' => fake()->randomFloat(1, 0, 200) . ' x ' . fake()->randomFloat(1, 0, 200) . ' (' . fake()->randomNumber(2) . fake()->randomElement(['', ' 1/8', ' 1/4', ' 3/8', ' 1/2', ' 5/8', ' 3/4', ' 7/8']) . ' x ' . fake()->randomNumber(2) . fake()->randomElement(['', ' 1/8', ' 1/4', ' 3/8', ' 1/2', ' 5/8', ' 3/4', ' 7/8']) . ' in.)',
                'dimensions_detail' => $this->fakeDimensionsDetail(3),
                'medium_display' => ucfirst(fake()->word) . ' on ' . fake()->word,
                'credit_line' => fake()->randomElement(['', 'Friends of ', 'Gift of ', 'Bequest of ']) . fake()->words(3, true),
                'inscriptions' => fake()->words(4, true),
                'publication_history' => fake()->paragraph(5),
                'exhibition_history' => fake()->paragraph(5),
                'provenance' => fake()->paragraph(5),
                'publishing_verification_level' => fake()->randomElement(['Web Basic', 'Web Cataloged', 'Web Everything']),
                'is_public_domain' => fake()->boolean,
                'copyright_notice' => '© ' . fake()->year . ' ' . ucfirst(fake()->words(3, true)),
                'artwork_type_id' => fake()->randomElement(ArtworkType::query()->pluck('id')->all()),
                'gallery_id' => fake()->randomElement(Place::query()->pluck('id')->all()),
                'edition' => fake()->randomNumber(1) . ' of ' . fake()->randomNumber(2, true),
            ],
            $this->dates(true)
        );
    }

    protected function fakeDimensionsDetail(int $count = 1): array
    {
        $dimensions = [];

        for ($i = 0; $i < $count; $i++) {
            $dimensions[] = [
                'clarification' => ucfirst(fake()->word()),
                'diameter' => fake()->randomFloat(),
                'depth' => fake()->randomFloat(),
                'height' => fake()->randomFloat(),
                'width' => fake()->randomFloat(),
            ];
        }
        return $dimensions;
    }
}
