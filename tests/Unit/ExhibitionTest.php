<?php

namespace Tests\Unit;

use App\Models\Collections\Exhibition;
use App\Models\Collections\Place;
use App\Models\Collections\Agent;

class ExhibitionTest extends ApiTestCase
{

    protected $model = Exhibition::class;

    protected $keys = ['lake_guid'];

    /**
     * @link https://github.com/art-institute-of-chicago/aic-mobile-cms/blob/b74ddc9/sites/all/modules/custom/aicapp/includes/aicapp.admin.inc#L788
     * @link https://github.com/art-institute-of-chicago/aic-mobile-ios/blob/72bb520/aic/aic/Data/SearchDataManager.swift#L132
     */
    protected $fieldsUsedByMobile = [
        'id',
        'title',
        'status',
        // 'description',
        'short_description',
        // 'image_iiif_url',
        'legacy_image_mobile_url',
        'legacy_image_desktop_url',
        'gallery_id',
        'web_url',
        'aic_start_at',
        'aic_end_at',
    ];

    public function setUp()
    {

        parent::setUp();
        $this->make(Place::class, ['type' => 'AIC Gallery']);
        $this->times(5)->make(Agent::class);

    }

}
