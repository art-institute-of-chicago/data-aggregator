<?php

namespace Tests\Unit;

use App\Models\Dsc\Footnote;
use App\Models\Dsc\Publication;
use App\Models\Dsc\Section;

class FootnoteTest extends ApiTestCase
{

    protected $model = Footnote::class;

    protected $route = 'footnotes';

    public function setUp()
    {

        parent::setUp();
        $this->make(Publication::class);
        $this->times(5)->make(Section::class);

    }

}
