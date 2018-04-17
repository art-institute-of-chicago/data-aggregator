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

    protected $dates = [
        'source_created_at',
        'source_modified_at',
        'source_indexed_at',
        'citi_created_at',
        'citi_modified_at',
    ];

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
