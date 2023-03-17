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
        $date_end = $this->faker->year;
        $artist = Agent::where('agent_type_id', AgentType::where('title', 'Individual')->first()->id)->get()->random();
        return array_merge(
            $this->idsAndTitle(ucwords($this->faker->words(4, true)), true, 6),
            [
                'main_id' => $this->faker->accession,
                'date_display' => '' . $date_end,
                'date_start' => $this->faker->year,
                'date_end' => $date_end,
                'description' => $this->faker->paragraph(5),
                'artist_display' => $artist->title_raw . "\n" . $this->faker->country . ', ' . $this->faker->year . '–' . $this->faker->year,
                'dimensions' => $this->faker->randomFloat(1, 0, 200) . ' x ' . $this->faker->randomFloat(1, 0, 200) . ' (' . $this->faker->randomNumber(2) . $this->faker->randomElement(['', ' 1/8', ' 1/4', ' 3/8', ' 1/2', ' 5/8', ' 3/4', ' 7/8']) . ' x ' . $this->faker->randomNumber(2) . $this->faker->randomElement(['', ' 1/8', ' 1/4', ' 3/8', ' 1/2', ' 5/8', ' 3/4', ' 7/8']) . ' in.)',
                'dimensions_detail' => $this->fakeDimensionsDetail(3),
                'medium_display' => ucfirst($this->faker->word) . ' on ' . $this->faker->word,
                'credit_line' => $this->faker->randomElement(['', 'Friends of ', 'Gift of ', 'Bequest of ']) . $this->faker->words(3, true),
                'inscriptions' => $this->faker->words(4, true),
                'publication_history' => $this->faker->paragraph(5),
                'exhibition_history' => $this->faker->paragraph(5),
                'provenance' => $this->faker->paragraph(5),
                'publishing_verification_level' => $this->faker->randomElement(['Web Basic', 'Web Cataloged', 'Web Everything']),
                'is_public_domain' => $this->faker->boolean,
                'copyright_notice' => '© ' . $this->faker->year . ' ' . ucfirst($this->faker->words(3, true)),
                'artwork_type_id' => $this->faker->randomElement(ArtworkType::query()->pluck('id')->all()),
                'gallery_id' => $this->faker->randomElement(Place::query()->pluck('id')->all()),
                'edition' => $this->faker->randomNumber(1) . ' of ' . $this->faker->randomNumber(2, true),
            ],
            $this->dates(true)
        );
    }

    protected function fakeDimensionsDetail(int $count = 1): array
    {
        $dimensions = array();
        for ($i = 0; $i < $count; $i++) {
            $dimensions[] = [
                'clarification' => ucfirst($this->faker->word()),
                'diameter' => $this->faker->randomFloat(),
                'depth' => $this->faker->randomFloat(),
                'height' => $this->faker->randomFloat(),
                'width' => $this->faker->randomFloat(),
            ];
        }
        return $dimensions;
    }
}
