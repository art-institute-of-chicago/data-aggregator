<?php

namespace App\Console\Commands\Import;

use App\Models\Archive\ArchiveImage;

class ImportArchive extends AbstractImportCommand
{

    protected $signature = 'import:archive
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = 'Import all archives data';

    public function handle()
    {
        $this->api = env('ARCHIVES_DATA_SERVICE_URL');

        if (!$this->reset()) {
            return false;
        }

        $this->import('Archive', ArchiveImage::class, 'archival-images');
    }

    protected function reset()
    {
        return $this->resetData(
            [
                // ArchiveImage::class,
            ],
            [
                'archival_images',
            ]
        );
    }

}
