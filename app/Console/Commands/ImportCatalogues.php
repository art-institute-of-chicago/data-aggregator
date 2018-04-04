<?php

namespace App\Console\Commands;

use App\Models\Dsc\Publication;
use App\Models\Dsc\Section;

class ImportCatalogues extends AbstractImportCommandNew
{

    protected $signature = 'import:dsc
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all catalogue data";


    public function handle()
    {

        $this->api = env('DSC_DATA_SERVICE_URL');

        $hasReset = $this->reset(
            [
                Publication::class,
                Section::class,
            ],
            [
                'sections',
                'publications',
            ]
        );

        if( !$hasReset )
        {
            return false;
        }

        $this->import(Publication::class, 'publications');
        $this->import(Section::class, 'sections');

        $this->info("Imported all Publications and Sections from data service!");

    }

}
