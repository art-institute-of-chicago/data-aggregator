<?php

namespace Tests\Unit;

use App\Models\Collections\Artwork;
use App\Models\Collections\ArtworkDate;

class ArtworkDateTest extends ApiTestCase
{

    protected $model = ArtworkDate::class;

    protected $keys = ['lake_guid'];

    public function setUp()
    {

        parent::setUp();

        $this->times(5)->make(Artwork::class);

    }
}
