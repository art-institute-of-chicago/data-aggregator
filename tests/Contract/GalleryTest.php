<?php

namespace Tests\Contract;

use App\Models\Collections\Gallery;

class GalleryTest extends ContractTestCase
{
    protected $model = Gallery::class;

    /** @test
     * List of fields taken from https://docs.google.com/spreadsheets/d/1F8YkAb-xaAAfsuWtXmll84nthfsfbBnxm4yU3lX0uLY
     */
    public function it_fetches_fields_used_by_mobile()
    {
        $this->it_fetches_fields([
            'title',
            'id',
            'number',
            'floor',
            'latitude',
            'longitude',
            'is_closed',
        ]);
    }
}
