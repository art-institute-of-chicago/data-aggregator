<?php

namespace App\Console\Commands\Docs;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CreateFieldsDocs extends AbstractDocCommand
{

    protected $signature = 'docs:fields';

    protected $description = 'Generate documentation for all the fields on each endpoint';

    public function handle()
    {
        $doc = "# Fields\n\n";

        foreach ($this->getCategories() as $namespace => $heading)
        {
            $doc .= "## ${heading}\n\n";

            foreach ($this->getModelsForNamespace($namespace) as $model)
            {
                $doc .= $model::instance()->docFields();
            }
        }

        Storage::disk('local')->put('FIELDS.md', $doc);

        copy(storage_path('app/FIELDS.md'),
             base_path('docs/fields/README.md'));

    }

}
