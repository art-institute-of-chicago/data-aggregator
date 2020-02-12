<?php

namespace Tests\Contract;

use Tests\TestCase;

use App\Models\Collections\Artwork;

class ArtworkTest extends ContractTestCase
{

    protected $model = Artwork::class;

    protected $fieldsUsedByMobile = [
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
    ];

}
