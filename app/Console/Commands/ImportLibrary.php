<?php

namespace App\Console\Commands;

use App\Models\Library\Material;
use App\Models\Library\Term;

class ImportLibrary extends AbstractImportCommandNew
{

    protected $signature = 'import:library
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = "Import all library data";


    public function handle()
    {

        $this->api = env('LIBRARY_DATA_SERVICE_URL');

        if( !$this->reset() )
        {
            return false;
        }

        $this->import( Material::class, 'materials' );

        $this->info("Imported all library materials from data service!");

        $this->import( Term::class, 'terms');

        $this->info("Imported all library terms from data service!");

    }

    protected function reset()
    {

        return $this->resetData(
            [
                // Material::class,
                // Term::class,
            ],
            [
                'library_materials',
                'library_terms',
            ]
        );

    }

}
