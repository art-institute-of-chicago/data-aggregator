<?php

namespace App\Console\Commands\Report;

use App\Models\Collections\Agent;

use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportTerms extends BaseCommand
{

    protected $signature = 'report:terms {artistId}';

    protected $description = 'Export all terms associated with an artist\'s artworks';

    public function handle()
    {
        $artistId = $this->argument('artistId');

        $terms = Agent::findOrFail($artistId)
            ->createdArtworks
            ->pluck('terms')
            ->collapse()
            ->unique('lake_uid')
            ->sortBy([
                ['subtype', 'asc'],
                ['lake_uid', 'asc'],
            ])
            ->values();

        $csv = Writer::createFromString('');

        $csv->insertOne([
            'term_type',
            'term_id',
            'term_title',
            'aat_id',
        ]);

        foreach ($terms as $term) {
            $row = [
                'term_type' => $term->getSubtypeDisplay(),
                'term_id' => $term->lake_uid,
                'term_title' => $term->title,
                'aat_id' => null,
            ];

            $this->info(json_encode(array_values($row)));
            $csv->insertOne($row);
        }

        Storage::put('terms-for-' . $artistId . '.csv', $csv->getContent());
    }
}
