<?php

namespace App\Console\Commands\Dump;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Exception;
use Throwable;

class DumpExportJsonl extends AbstractDumpCommand
{

    protected $signature = 'dump:getting-started';

    protected $description = 'Create a getting started JSON dumps of all artworks';

    public function handle()
    {
        // Get all models for export
        $model = \App\Models\Collections\Artwork::class;

        // Remove the old getting started JSON in this dump
        $filepath = $this->getDumpPath('local/getting-started');
        if (!file_exists($filepath)) {
            mkdir($filepath, 1777, true);
        }
        array_map('unlink', glob($filepath . '/artworks.json') ?: []);

        // Create transformer used for generating JSON output
        $transformer = app('Resources')->getTransformerForModel($model);
        $transformer = new $transformer;

        $model::addRestrictContentScopes();

        // Give feedback to the user
        $this->info('Getting started artworks JSON');
        $bar = $this->output->createProgressBar($model::count());

        $content = '';

        // Loop through each record and dump its contents into a file
        $model::with(['departments', 'artists'])->chunk(100, function ($items) use ($transformer, $model, $bar, &$content) {
            foreach ($items as $key => $item) {
                $content .= '{"id":' . $item->citi_id . ',"title":"' . addslashes($item->title) . '","main_reference_number":"' . $item->main_id . '","department_title":"' . ($item->departments->first()->title ?? null) . '","artist_title":"' . ($item->artist->title ?? null) . "\"}\n";
            }
            $bar->advance($items->count());
        });
        $bar->finish();
        $this->output->newLine(1);

        Storage::disk('dumps')->put('local/getting-started/artworks.json', $content);
    }
}
