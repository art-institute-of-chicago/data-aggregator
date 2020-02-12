<?php

namespace Tests\Contract;

use App\Models\Collections\Gallery;

class GalleryTest extends ContractTestCase
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
