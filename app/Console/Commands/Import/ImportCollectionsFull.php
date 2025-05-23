<?php

namespace App\Console\Commands\Import;

use App\Behaviors\HandleEmbeddings;

class ImportCollectionsFull extends AbstractImportCommand
{
    use HandleEmbeddings;

    protected $signature = 'import:collections-full
                            {endpoint? : Endpoint on dataservice to query, e.g. `object-types`}
                            {page? : Page to begin importing from}
                            {--test : Only import one page from each endpoint}';

    protected $description = 'Import all collections data. If no options are passed all Collections data will be imported.';

    public function handle()
    {
        if ($this->option('test')) {
            $this->isTest = true;
        }

        $this->api = config('resources.sources.collections');

        $endpoint = $this->argument('endpoint');

        if ($endpoint) {
            $page = $this->argument('page') ?: 1;
            $this->importEndpoint($endpoint, $page);
        } else {
            $this->importEndpoints();
        }
    }

    protected function importEndpoints()
    {
        // Lists:
        $this->importEndpoint('artwork-agent-roles');
        $this->importEndpoint('artwork-date-qualifiers');
        $this->importEndpoint('artwork-place-qualifiers');
        $this->importEndpoint('object-types');
        $this->importEndpoint('agent-types');
        $this->importEndpoint('categories');
        $this->importEndpoint('terms');

        $this->importEndpoint('places');
        $this->importEndpoint('galleries');

        $this->importEndpoint('agents');
        $this->importEndpoint('exhibitions');
        $this->importEndpoint('artworks');
    }

    protected function importEndpoint($endpoint, $page = 1)
    {
        $model = $this->getModelForEndpoint($endpoint);

        if (!$this->isPartial && app('Resources')->isModelSearchable($model)) {
            $model::disableSearchSyncing();
        }

        $this->import('Collections', $model, $endpoint, $page);

        if (!$this->isPartial && app('Resources')->isModelSearchable($model)) {
            $model::enableSearchSyncing();
        }
    }

    protected function getModelForEndpoint($endpoint)
    {
        return app('Resources')->getModelForInboundEndpoint($endpoint, 'collections');
    }

    /**
     * Temporarily overriding this to have control over the `$limit` default here.
     */
    protected function query($endpoint, $page = 1, $limit = 500)
    {
        return parent::query($endpoint, $page, 50);
    }

    /**
     * If an artwork was updated, and if the primary image was updated, reimport the
     * image embeddings.
     *
     * @param \Illuminate\Database\Eloquent\Model
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function afterSave($resource)
    {
        if (get_class($resource) == \App\Models\Collections\Artwork::class) {
            // If the primary image was updated in the last five minute,
            // or if this artwork doesn't have either of the embeddings,
            // retrieve fresh embeddings
            if (!$resource->imageEmbedding || !$resource->textEmbedding || $resource?->image->source_updated_at > now()->subMinutes(5)) {
                $this->generateAndSaveArtworkEmbeddngs($resource, $this);
            }
        }
        return $resource;
    }


    /**
     * This method will take an array of ids and return an array of URLs to the CDS API,
     * which utilize the `?ids=a,b,c` syntax. It'll iterate on chunking the ids until the
     * URLs it generates all satisfy a reasonable length criteria (600 chars).
     *
     * @param string $endpoint
     *
     * @return array
     */
    private function getUrls(array $ids, $endpoint)
    {
        $n = 0;

        do {
            $n++;

            $chunked_ids = partition($ids, $n);

            $urls = array_map(function ($ids) use ($endpoint) {
                return config('resources.sources.collections')
                    . '/' . $endpoint
                    . '?limit=' . count($ids)
                    . '&ids=' . implode(',', $ids);
            }, $chunked_ids);

            // Don't generate a URL longer than 600 characters, including prefix
            $max_url_length = max(array_map('strlen', $urls));
        } while ($max_url_length > 600);

        return $urls;
    }
}
