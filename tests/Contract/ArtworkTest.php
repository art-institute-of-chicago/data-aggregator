<?php

namespace Tests\Contract;

use Tests\TestCase;

use App\Models\Collections\Artwork;

class ArtworkTest extends ContractTestCase
{

    protected $model = Artwork::class;

    /** @test
     * List of fields taken from https://docs.google.com/spreadsheets/d/1F8YkAb-xaAAfsuWtXmll84nthfsfbBnxm4yU3lX0uLY
     */
    public function it_fetches_fields_used_by_mobile() {
        $this->it_fetches_fields([
            'title',
            'gallery_title',
            'id',
            'main_reference_number',
            'artist_display',
            'credit_line',
            'date_display',
            'is_on_view',
            'date_start',
            'date_end',
            'copyright_notice',
            'gallery_id',
            'image_id',
        ]);
    }
}
