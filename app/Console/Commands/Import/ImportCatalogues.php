<?php

namespace App\Console\Commands\Import;

use App\Models\Dsc\Publication;
use App\Models\Dsc\Section;

class ImportCatalogues extends AbstractImportCommand
{

    protected $signature = 'import:dsc
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = 'Import all catalogue data';

    public function handle()
    {

        $this->api = env('DSC_DATA_SERVICE_URL');

        if (!$this->reset())
        {
            return false;
        }

        $this->import('Dsc', Publication::class, 'publications');
        $this->import('Dsc', Section::class, 'sections');

    }

    protected function reset()
    {

        return $this->resetData(
            [
                Publication::class,
                Section::class,
            ],
            [
                'sections',
                'publications',
            ]
        );

    }

}
