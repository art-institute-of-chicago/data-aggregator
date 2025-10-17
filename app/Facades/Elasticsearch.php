<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;

/**
 * Class Facade
 */
class Elasticsearch extends BaseFacade
{
    /**
     * @inheritdoc
     */
    protected static function getFacadeAccessor()
    {
        return 'elasticsearch';
    }
}
