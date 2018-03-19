<?php

namespace App\Jobs;

use App\Behaviors\CanQuery;

class PullRecord extends AbstractJob
{

    use CanQuery;

    protected $endpoint;
    protected $id;

    public function __construct($endpoint, $id)
    {

        $this->endpoint = $endpoint;
        $this->id = $id;

    }

    public function handle()
    {

        $model = app('Resources')->getModelForEndpoint($this->endpoint);

        $resource = $this->queryResource($this->endpoint, $this->id);
        $this->saveDatum( $resource->data, $model );

    }

}
