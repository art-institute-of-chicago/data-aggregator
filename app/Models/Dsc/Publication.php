<?php

namespace App\Models\Dsc;

use App\Models\DscModel;
use App\Models\ElasticSearchable;

/**
 * Represents an overall digital publication.
 */
class Publication extends DscModel
{

    use ElasticSearchable;

    private static $genericPageIds = [
        7 => 9,
        12 => 6,
        135446 => 12,
        141096 => 7,
        135466 => 11,
        406 => 13,
        445 => 8,
        480 => 5,
        226 => 10,
        140019 => 4,
    ];

    public function sections()
    {
        return $this->hasMany('App\Models\Dsc\Section');
    }

    /**
     * WEB-35, API-332: Each publication is represented by a generic
     * page on our website, which links to that publication.
     */
    public function getGenericPageId()
    {
        return self::$genericPageIds[$this->id] ?? null;
    }
}
