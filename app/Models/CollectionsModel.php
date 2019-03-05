<?php

namespace App\Models;

use App\Models\BaseModel;

class CollectionsModel extends BaseModel
{

    public static $sourceLastUpdateDateField = 'indexed_at';

    protected static $source = 'Collections';

    protected $fakeIdsStartAt = 999000000;

    protected $isInCiti = true;

}
