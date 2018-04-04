<?php

namespace App\Console\Commands;

use App\Models\Archive\ArchiveImage;

class ImportArchive extends AbstractImportCommandNew
{

    protected $signature = 'import:archive
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all archives data";


    public function handle()
    {

        $this->api = env('ARCHIVES_DATA_SERVICE_URL');

        $hasReset = $this->reset( ArchiveImage::class, 'archival_images' );

        if( !$hasReset )
        {
            return false;
        }

        $this->import( ArchiveImage::class, 'archival-images' );

        $this->info("Imported all archive images from data service!");

    }

}
