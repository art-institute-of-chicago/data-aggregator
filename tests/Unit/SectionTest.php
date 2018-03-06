<?php

namespace Tests\Unit;

use App\Models\Dsc\Section;
use App\Models\Dsc\Publication;

class SectionTest extends ApiTestCase
{

    protected $model = Section::class;

    public function setUp()
    {

        parent::setUp();
        $this->make(Publication::class);

    }

}
