<?php

namespace Tests\Unit;

use App\Models\Collections\ArtworkType;

class ArtworkTypeTest extends ApiTestCase
{

    protected $model = ArtworkType::class;

    protected $route = 'artwork-types';

    protected $keys = ['lake_guid'];

}
