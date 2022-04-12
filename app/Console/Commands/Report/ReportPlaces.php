<?php

namespace App\Console\Commands\Report;

use App\Models\Collections\Agent;

use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportPlaces extends BaseCommand
{

    protected $signature = 'report:places {artistId}';

    protected $description = 'Export all places associated with an artist\'s artworks';

    public function handle()
    {
        $artistId = $this->argument('artistId');

        $items = Agent::findOrFail($artistId)
            ->createdArtworks
            ->pluck('places')
            ->collapse()
            ->unique('citi_id')
            ->sortBy([
                ['citi_id', 'asc'],
            ])
            ->values();

        $csv = Writer::createFromString('');

        $csv->insertOne([
            'id',
            'title',
            'latitude',
            'longitude',
        ]);

        foreach ($items as $item) {
            $row = [
                'id' => $item->citi_id,
                'title' => $item->title,
                'latitude' => $item->latitude,
                'longitude' => $item->longitude,
            ];

            $this->info(json_encode(array_values($row)));
            $csv->insertOne($row);
        }

        Storage::put('places-for-' . $artistId . '.csv', $csv->getContent());
    }
}
