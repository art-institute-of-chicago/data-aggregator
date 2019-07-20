<?php

namespace App\Console\Commands\Delete;

use Carbon\Carbon;
use App\Console\Commands\Import\AbstractImportCommand;

class DeleteCollections extends AbstractImportCommand
{

    protected $signature = 'delete:collections
                            {--since= : How far back to scan for records}';

    protected $description = 'Delete records that have been removed from CITI';

    protected $chunkSize = 100;

    public function handle()
    {
        $this->api = env('COLLECTIONS_DATA_SERVICE_URL');

        $this->deleteByEndpoint();

        // TODO: See Redmine CITI-3400 for gallery unpublishing
        $this->deleteById('galleries');
    }

    private function deleteByEndpoint()
    {
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
                    $resource = app('Resources')->getResourceForInboundEndpoint($datum->type, 'collections');
                    $modelClass = $resource['model'];
                } catch (\Throwable $e) {
                    // Assume that this `type` isn't being imported
                    continue;
                }

                // Break if we're past the last time we checked
                $deletedAt = new Carbon($datum->modified_at);

                if ($this->since->gt($deletedAt)) {
                    break 2;
                }

                $entity = $modelClass::find($this->getId($datum->deleted_id, $datum->type));

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

    private function deleteById(string $endpoint)
    {
        $resource = app('Resources')->getResourceForInboundEndpoint($endpoint, 'collections');
        $modelClass = $resource['model'];

        $modelClass::chunk($this->chunkSize, function ($resources) use ($modelClass, $endpoint) {
            $this->info('Checking ' . $endpoint . ' at ' . $resources->pluck($modelClass::instance()->getKeyName())->first());

            $daIds = $resources->pluck($modelClass::instance()->getKeyName());

            $url = env('COLLECTIONS_DATA_SERVICE_URL') . '/' . $endpoint . '?' . http_build_query([
                'fields' => 'id',
                'limit' => $this->chunkSize,
                'ids' => implode(',', $daIds->all()),
            ]);

            $contents = file_get_contents($url, false, stream_context_create([
                'http'=> [
                    'timeout' => 10,
                ]
            ]));

            $json = json_decode($contents);

            $cdsIds = collect($json->data)->pluck('id');

            $diff = $daIds->diff($cdsIds)->all();

            if ($diff) {
                $this->warn('Deleting ' . implode(', ', $diff));
                $modelClass::destroy($diff);
            }
        });
    }

    // TODO: Move this to inbound transformer!
    private function getId($id, $type)
    {
        switch ($type) {
            case 'categories':
                return 'PC-' . $id;
                break;
            case 'terms':
                return 'TM-' . $id;
                break;
            default:
                return $id;
        }
    }

}
