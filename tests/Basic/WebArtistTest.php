<?php

namespace Tests\Basic;

use App\Models\Web\Artist;

class WebArtistTest extends BasicTestCase
{

    protected $model = Artist::class;

    protected $route = 'web-artists';

}
