<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Dsc\TitlePage;
use App\Models\Dsc\Publication;

class TitlePageTest extends ApiTestCase
{

    protected $model = TitlePage::class;

    protected $route = 'title-pages';

    public function setUp()
    {

        parent::setUp();
        $this->make(Publication::class);

    }

}
