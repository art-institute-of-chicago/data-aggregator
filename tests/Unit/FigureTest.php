<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Dsc\Figure;
use App\Models\Dsc\Publication;
use App\Models\Dsc\Section;

class FigureTest extends ApiTestCase
{

    protected $model = Figure::class;

    protected $route = 'figures';

    public function setUp()
    {

        parent::setUp();
        $this->make(Publication::class);
        $this->times(5)->make(Section::class);

    }

}
