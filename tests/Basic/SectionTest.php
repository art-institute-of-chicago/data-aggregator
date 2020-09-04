<?php

namespace Tests\Basic;

use App\Models\Dsc\Section;
use App\Models\Dsc\Publication;

class SectionTest extends BasicTestCase
{

    protected $model = Section::class;

    protected function setUp(): void
    {
        parent::setUp();
        $this->make(Publication::class);
    }
}
