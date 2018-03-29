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

    protected $primaryKey = 'lake_uid';
    protected $keyType = 'string';
    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'citi_created_at', 'citi_modified_at'];
    protected $fakeIdsStartAt = 99900;

    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "TT-5";

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

    /**
     * Ensure that the id is a valid LAKE UID.
     *
     * @param mixed $id
     * @return boolean
     */
    public static function validateId($id)
    {

        $uid = '/^[A-Z]{2}-[0-9]+$/i';

        return preg_match($uid, $id);

    }

}
