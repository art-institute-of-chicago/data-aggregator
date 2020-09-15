<?php

namespace App\Console\Commands\Docs;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CreateEndpointDocs extends AbstractDocCommand
{

    protected $signature = 'docs:endpoints';

    protected $description = 'Generate documentation for API endpoints';

    public function handle()
    {
        $doc = "## Endpoints\n\n";

        foreach ($this->getCategories() as $namespace => $heading) {
            $doc .= "### ${heading}\n\n";

            foreach ($this->getModelsForNamespace($namespace) as $model) {
                $doc .= $model::instance()->docEndpoints();
            }
        }

        Storage::disk('local')->put('ENDPOINTS.md', $doc);

        copy(
            storage_path('app/ENDPOINTS.md'),
            base_path('docs/.sections/endpoints.md')
        );
    }
}
