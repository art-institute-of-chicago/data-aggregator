<?php

namespace App\Models;

use App\Models\BaseModel;

class CollectionsModel extends BaseModel
{

    public static $sourceLastUpdateDateField = 'indexed_at';

    protected static $source = 'Collections';

    protected $fakeIdsStartAt = 999000000;

    protected $isInCiti = true;

    public function getCasts()
    {

        $casts = parent::getCasts();

        if (!$this->hasSourceDates)
        {
            return $casts;
        }

        // This accounts for Assets, which are in LAKE, but not in CITI
        if ($this->isInCiti)
        {
            $casts = array_merge( $casts, [
                'citi_created_at' => 'datetime',
                'citi_modified_at' => 'datetime',
            ]);
        }

        return array_merge( $casts, [
            'source_indexed_at' => 'datetime',
        ]);

    }

}
