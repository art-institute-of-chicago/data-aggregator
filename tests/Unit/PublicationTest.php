<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Dsc\Publication;

class PublicationTest extends ApiTestCase
{

    protected $model = Publication::class;

    protected $route = 'publications';

}
