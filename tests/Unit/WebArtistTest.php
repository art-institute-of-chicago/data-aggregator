<?php

namespace Tests\Unit;

use App\Models\Web\Artist;

class WebArtistTest extends ApiTestCase
{

    protected $model = Artist::class;

    protected $route = 'web-artists';

}
