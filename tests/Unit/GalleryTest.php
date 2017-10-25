<?php

namespace Tests\Unit;

use App\Models\Collections\Gallery;

class GalleryTest extends ApiTestCase
{

    protected $model = Gallery::class;

    protected $route = 'galleries';

    protected $keys = ['lake_guid'];

}
