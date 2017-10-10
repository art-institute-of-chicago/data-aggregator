<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
