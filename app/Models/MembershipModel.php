<?php

namespace App\Models;

use App\Models\BaseModel;

class MembershipModel extends BaseModel
{

    protected static $source = 'Membership';

    protected $primaryKey = 'membership_id';

    protected $dates = ['source_created_at', 'source_modified_at'];

    protected function fillIdsFrom($source)
    {

        $this->membership_id = $source->id;

        return $this;

    }

    public function docMembershipEndpoint($appUrl = '')
    {

        $doc = '';

        $doc .= "## Members\n\n";

        $doc .= "### `/members/{id}?zip=XXX`\n\n";

        $doc .= "A single member by the given identifier. Will only provide results if a valid verification parameter is passed.\n\n";

        $doc .= "#### Available parameters:\n\n";

        $doc .= "* `zip` - The zip code matching the requested member record\n";
        $doc .= "* `email` - The email address matching the requested member record\n";
        $doc .= "* `phone` - The phone number matching the requested member record\n";

        return $doc;
    }
}
