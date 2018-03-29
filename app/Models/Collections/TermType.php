<?php

namespace App\Models\Collections;

use App\Models\CollectionsModel;
use App\Models\Documentable;

/**
 * A kind of term, e.g. Subject,
 */
class TermType extends CollectionsModel
{

    use Documentable;

    public const CLASSIFICATION = 1;
    public const MATERIAL = 2;
    public const TECHNIQUE = 3;
    public const STYLE = 4;
    public const SUBJECT = 5;

    protected $primaryKey = 'citi_id';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];
    protected $fakeIdsStartAt = 99900;

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return 5;

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
