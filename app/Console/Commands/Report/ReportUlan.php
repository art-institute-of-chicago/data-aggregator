<?php

namespace App\Console\Commands\Report;

use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportUlan extends BaseCommand
{

    protected $signature = 'report:ulan';

    protected $description = 'Export ULAN mapping';

    public function handle()
    {
        $csv = Writer::createFromString('');

        $csv->insertOne([
            'id',
            'ulan_uri',
            'ulan_certainty',
            'title',
            'birth_date',
            'death_date',
        ]);

        $artists = \App\Models\Collections\Agent::whereNotNull('ulan_uri')->orderBy('ulan_certainty','asc')->orderBy('sort_title', 'asc');

        foreach ($artists->cursor() as $artist) {
            $row = [
                'id' => $artist->citi_id,
                'ulan_uri' => $artist->ulan_uri,
                'ulan_certainty' => $artist->ulan_certainty,
                'title' => $artist->sort_title ?? $artist->title,
                'birth_date' => $artist->birth_date,
                'death_date' => $artist->death_date,
            ];

            $this->info(json_encode(array_values($row)));
            $csv->insertOne($row);
        }

        Storage::put('agents-ulan.csv', $csv->getContent());
    }

}
