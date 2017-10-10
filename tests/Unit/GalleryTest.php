<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\Collections\Gallery;

class GalleryTest extends ApiTestCase
{

    protected $model = Gallery::class;

    protected $route = 'galleries';

    protected $keys = ['lake_guid'];

}
