<?php

namespace Tests\Unit;

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

    /**
     * Return an id that is valid, yet has a negligent likelihood of pointing at an actual object.
     * Must pass the FiguresController's `validateId` check.
     *
     * @var string
     */
    protected function getRandomId()
    {
        return 'fig-' . $this->faker->unique()->randomNumber(3) . '-' . $this->faker->unique()->randomNumber(3);
    }

}
