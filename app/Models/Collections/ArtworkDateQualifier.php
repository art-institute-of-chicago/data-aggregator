<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\Documentable;

/**
 * A kind of date on at artwork, e.g., Made, Reconstructed, Published, etc.
 */
class ArtworkDateQualifier extends CollectionsModel
{

    use Documentable;

    protected $primaryKey = 'citi_id';

    protected $fakeIdsStartAt = 9900;

}
