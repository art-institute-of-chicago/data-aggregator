<?php

namespace Tests\Unit;

use App\Models\Membership\LegacyEvent;

class LegacyEventTest extends ApiTestCase
{

    protected $model = LegacyEvent::class;

    protected $route = 'legacy-events';

    protected $fieldsUsedByMobile = ['id',
                                     'title',
                                     'description',
                                     'short_description',
                                     'image',
                                     'start_at',
                                     'end_at',
                                     'button_text',
                                     'button_url',
    ];

}
