<?php

namespace Tests\Contract;

use PHPUnit\Framework\Attributes\Test;
use App\Models\Collections\Gallery;

class GalleryTest extends ContractTestCase
{
    protected $model = Gallery::class;

    /**
     * List of fields taken from https://docs.google.com/spreadsheets/d/1F8YkAb-xaAAfsuWtXmll84nthfsfbBnxm4yU3lX0uLY
     */
    #[Test]
    public function it_fetches_fields_used_by_mobile(): void
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
