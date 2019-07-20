<?php

namespace App\Console\Commands\Import;

use App\Models\Library\Material;
use App\Models\Library\Term;

class ImportLibrary extends AbstractImportCommand
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

        $this->import( 'Library', Material::class, 'materials' );
        $this->import( 'Library', Term::class, 'terms');

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
