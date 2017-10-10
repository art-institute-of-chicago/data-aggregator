<?php

namespace Tests\Unit;

use App\Models\Dsc\Collector;
use App\Models\Dsc\Publication;

class CollectorTest extends ApiTestCase
{

    protected $model = Collector::class;

    protected $route = 'collectors';

    public function setUp()
    {

        parent::setUp();
        $this->make(Publication::class);

    }

}
