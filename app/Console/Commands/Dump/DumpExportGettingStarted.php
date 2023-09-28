<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;

class DumpExportGettingStarted extends AbstractDumpCommand
{
    protected $signature = 'dump:getting-started';

    protected $description = 'Create a getting started JSON dumps of all artworks';

    public function handle()
    {
        ini_set('memory_limit', '-1');

        // Get all models for export
        $model = \App\Models\Collections\Artwork::class;

        // Remove the old getting started JSON in this dump
        $filepath = $this->getDumpPath('local/getting-started');

        if (!file_exists($filepath)) {
            mkdir($filepath, 0777, true);
        }
        $this->shell->passthru('rm -rf %s/*', $filepath);

        // Create transformer used for generating JSON output
        $transformer = app('Resources')->getTransformerForModel($model);
        $transformer = new $transformer();

        $csv = $this->getNewWriter($filepath . '/someArtworks.csv', [
            'id',
            'title',
            'main_reference_number',
            'department_title',
            'artist_title',
        ]);

        $model::addRestrictContentScopes(true);

        // Give feedback to the user
        $this->info('Getting started on artworks');
        $bar = $this->output->createProgressBar($model::count());

        Storage::disk('dumps')->put('local/getting-started/allArtworks.jsonl', '');

        $json = fopen(Storage::disk('dumps')->path('local/getting-started/allArtworks.jsonl'), 'a');

        $artworks = $model::query()
            ->select('id', 'title', 'main_id', 'department_id')
            ->setEagerLoads([
                'artistPivots',
                'categories',
            ]);

        // Loop through each record and dump its contents into a file
        foreach ($model::cursor() as $item) {
            // JSON
            fwrite($json, json_encode([
                'id' => $item->id,
                'title' => $item->title,
                'main_reference_number' => $item->main_id,
                'department_title' => ($item->departments->first()->title ?? null),
                'artist_title' => ($item->artist->title ?? null),
            ]) . PHP_EOL);

            // CSV
            if ($item->isBoosted()) {
                $csv->insertOne([
                    'id' => $item->id,
                    'title' => $item->title,
                    'main_reference_number' => $item->main_id,
                    'department_title' => ($item->departments->first()->title ?? null),
                    'artist_title' => ($item->artist->title ?? null),
                ]);
            }

            $bar->advance();
        }

        fclose($json);

        $bar->finish();
        $this->output->newLine(1);
    }

    private function getNewWriter($csvPath, $header)
    {
        $csv = Writer::createFromPath($csvPath, 'w');
        $csv->insertOne($header);
        return $csv;
    }
}
