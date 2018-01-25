<?php

namespace Tests\Unit;

use App\Models\Collections\Place;

class PlaceTest extends ApiTestCase
{

    protected $model = Place::class;

    protected $route = 'places';

    protected $keys = ['lake_guid'];

}
