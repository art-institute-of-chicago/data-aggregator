<?php

namespace Tests\Unit;

use App\Models\Collections\Gallery;

class GalleryTest extends ApiTestCase
{

    protected $model = Gallery::class;

    protected $fieldsUsedByMobile = [
        'title',
        'id',
        'number',
        'floor',
        'latitude',
        'longitude',
        'is_closed',
    ];

}
