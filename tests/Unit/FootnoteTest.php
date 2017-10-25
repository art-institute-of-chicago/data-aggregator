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

    /**
     * Return an id that is valid, yet has a negligent likelihood of pointing at an actual object.
     * Must pass the FootnotesController's `validateId` check.
     *
     * @var string
     */
    protected function getRandomId()
    {
        return 'fn-' . $this->faker->unique()->randomNumber(3) . '-' . $this->faker->unique()->randomNumber(3);
    }

}
