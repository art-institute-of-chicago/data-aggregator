<?php

namespace Tests\Contract;

use App\Models\Collections\Exhibition;
use App\Models\Collections\Place;
use App\Models\Collections\Agent;

class ExhibitionTest extends ContractTestCase
{

    protected $model = Exhibition::class;

    /** @test
     * @link https://github.com/art-institute-of-chicago/aic-mobile-cms/blob/b74ddc9/sites/all/modules/custom/aicapp/includes/aicapp.admin.inc#L788
     * @link https://github.com/art-institute-of-chicago/aic-mobile-ios/blob/72bb520/aic/aic/Data/SearchDataManager.swift#L132
     */
    public function it_fetches_fields_used_by_mobile() {
        $this->it_fetches_fields([
            'id',
            'title',
            'status',
            // 'description',
            'short_description',
            // 'image_iiif_url',
            'gallery_id',
            'web_url',
            'aic_start_at',
            'aic_end_at',
        ]);
    }
}
