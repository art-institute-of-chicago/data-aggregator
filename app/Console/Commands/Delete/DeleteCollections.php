<?php

namespace App\Console\Commands\Delete;

use Carbon\Carbon;
use App\Console\Commands\Import\AbstractImportCommand;

class DeleteCollections extends AbstractImportCommand
{

    protected $signature = 'delete:collections
                            {--since= : How far back to scan for records}';

    protected $description = 'Delete records that have been removed from CITI';

    protected $chunkSize = 20;

    public function handle()
    {
        $this->api = env('COLLECTIONS_DATA_SERVICE_URL');

        $json = $this->query('deletes', 1, 1);

        // Assumes the dataservice has standardized pagination
        $total = $json->pagination->total;
        $totalPages = ceil($total/$this->chunkSize);

        for ($currentPage = 1; $currentPage <= $totalPages; $currentPage++)
        {
            $json = $this->query('deletes', $currentPage, $this->chunkSize);

            foreach ($json->data as $datum)
            {
                try {
                    $model = app('Resources')->getModelForInboundEndpoint($datum->type, 'collections');
                } catch (\Throwable $e) {
                    // Assume that this `type` isn't being imported
                    continue;
                }

                // Break if we're past the last time we checked
                $deletedAt = new Carbon($datum->modified_at);

                if ($this->since->gt($deletedAt)) {
                    break 2;
                }

                $entity = $model::find($datum->deleted_id);

                if (!$entity) {
                    continue;
                }

                // Ignore the change the if the record has been modified after the delete
                if ($entity->source_modified_at->gt($deletedAt)) {
                    continue;
                }

                $entity->delete();
            }
        }
    }

}
