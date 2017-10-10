<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Dsc\Section;
use App\Models\Dsc\Publication;

class SectionTest extends ApiTestCase
{

    protected $model = Section::class;

    protected $route = 'sections';

    public function setUp()
    {

        parent::setUp();
        $this->make(Publication::class);

    }

}
