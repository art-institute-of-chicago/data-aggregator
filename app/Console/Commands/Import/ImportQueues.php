<?php

namespace App\Console\Commands\Import;

use Illuminate\Support\Facades\Storage;

use App\Models\Queues\WaitTime;
use App\Transformers\Inbound\BaseTransformer;

class ImportQueues extends AbstractImportCommand
{

    protected $signature = 'import:queues
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = 'Import all queue wait time information';

    public function handle()
    {
        $this->api = env('QUEUES_DATA_SERVICE_URL');

        $endpoint = 'wait-times';

        foreach (WaitTime::$aicQueueIds as $id => $title) {
            $model = $this->getModelForEndpoint($endpoint);

            $transformer = app('Resources')->getInboundTransformerForModel($model, 'Queues');

            $json = $this->fetchItem($endpoint, $id);

            if (isset($json->data)) {
                $datum = $json->data;
                $datum->title = $title;

                $this->updateSentryTags($datum, $endpoint, 'Queues');

                $this->save($datum, $model, $transformer);
            }
        }
    }

    protected function reset()
    {
        return $this->resetData(
            [],
            [
                'wait_times'
            ]
        );
    }

    private function fetchItem($endpoint, $id)
    {
        $url = env('QUEUES_DATA_SERVICE_URL') . '/' . $endpoint . '/' . $id;

        $this->info('Fetching: ' . $url);

        return $this->fetch($url, true);
    }

    protected function getModelForEndpoint($endpoint)
    {
        return app('Resources')->getModelForInboundEndpoint($endpoint, 'queues');
    }
}
