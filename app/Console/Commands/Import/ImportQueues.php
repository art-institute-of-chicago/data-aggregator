<?php

namespace App\Console\Commands\Import;


class ImportQueues extends AbstractImportCommand
{

    protected $signature = 'import:queues
                            {--y|yes : Answer "yes" to all prompts}';

    protected $description = 'Import all queue wait time information';

    public function handle()
    {
        $endpoint = 'wait-times';
        $model = app('Resources')->getModelForInboundEndpoint($endpoint, 'queues');
        $transformer = app('Resources')->getInboundTransformerForModel($model, 'Queues');

        $url = config('aic.queues.api_url')
            . '/kiosk/data/'
            . config('aic.queues.api_key')
            . '?serial=web';

        $queues = $this->fetch($url, true);

        foreach ($queues as $datum) {
            $this->updateSentryTags($datum, $endpoint, 'Queues');
            $this->save($datum, $model, $transformer);
        }

        // TODO: Automatically delete any queues that are not in WaitTime:$aicQueueIds?
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
}
