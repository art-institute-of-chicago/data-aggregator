<?php

namespace App\Console\Commands\Report;

use League\Csv\Writer;
use Illuminate\Support\Facades\Storage;

use Aic\Hub\Foundation\AbstractCommand as BaseCommand;

class ReportOsci extends BaseCommand
{

    protected $signature = 'report:osci';

    protected $description = 'Export OSCI mapping';

    public function handle()
    {
        $csv = Writer::createFromString('');

        $csv->insertOne([
            'artwork_citi_id',
            'publication_title',
            'section_title',
            'web_url',
        ]);

        $sections = \App\Models\Dsc\Section::whereNotNull('artwork_citi_id');

        foreach ($sections->cursor() as $section) {
            $row = [
                'artwork_citi_id' => $section->artwork_citi_id,
                'publication_title' => $section->publication->title,
                'section_title' => $section->title,
                'web_url' => $section->web_url,
            ];

            $this->info(json_encode(array_values($row)));
            $csv->insertOne($row);
        }

        Storage::put('artwork-sections.csv', $csv->getContent());
    }

}
