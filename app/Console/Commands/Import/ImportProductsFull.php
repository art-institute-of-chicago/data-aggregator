<?php

namespace App\Console\Commands\Import;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use League\Csv\Reader;

class ImportProductsFull extends AbstractImportCommand
{
    protected $signature = 'import:products-full
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = 'Import all product data';

    public function handle()
    {
        // API-344: Make sure this matches upload filename in ProductController
        $stream = Storage::disk('s3')->getDriver()->readStream('DatahubChainDriveProductData.csv');

        if (!$stream) {
            throw new FileNotFoundException();
        }

        $csv = Reader::createFromStream($stream);
        $csv->setHeaderOffset(0);

        $csv->getHeader();
        $records = $csv->getRecords();

        foreach ($records as $datum) {
            $this->save(
                $datum,
                \App\Models\Shop\Product::class,
                \App\Transformers\Inbound\Shop\Product::class
            );
        }
    }

    protected function reset()
    {
        return $this->resetData(
            [
                Product::class,
            ],
            [
                'products',
            ]
        );
    }
}
