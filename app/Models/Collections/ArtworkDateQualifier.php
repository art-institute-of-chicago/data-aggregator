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

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return 53;

    }

    /**
     * Whether this resource has a `/search` endpoint
     *
     * @return boolean
     */
    public function hasSearchEndpoint()
    {

        return false;

    }

}
