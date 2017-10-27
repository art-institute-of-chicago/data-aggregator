<?php

namespace App\Models;

use App\Models\BaseModel;

class MembershipModel extends BaseModel
{

    protected static $source = 'Membership';

    protected $primaryKey = 'membership_id';

    protected $dates = ['source_created_at', 'source_modified_at'];

    protected $fakeIdsStartAt = 99900000;

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

        $doc .= "\n\n";

        return $doc;
    }

    public function docMembershipFields()
    {

        $doc = '';

        $doc .= "## Members\n\n";

        $doc .= "A member of the museum\n\n";

        $doc .= "* `id` - Unique identifier of this resource. Taken from the source system.\n";
        $doc .= "* `item_id` - Unique identifier indicating the type of membership\n";
        $doc .= "* `item_name` - The name of the type of membership\n";
        $doc .= "* `item_description` - Explanation of what the type of membership is\n";
        $doc .= "* `status` - Number indicating the status of the membership\n";
        $doc .= "* `status_description` - Explanation of the status of the membership\n";
        $doc .= "* `category` - Unique identifier of the category associated with this membership\n";
        $doc .= "* `sub_category` - Unique identifier of the subcategory associated with this membership\n";
        $doc .= "* `date_opened` - Date and time the membership was first created\n";
        $doc .= "* `date_used` - Date and time the membership was last used\n";
        $doc .= "* `valid_days` - Number indicating for how many more days the membership will be valid\n";
        $doc .= "* `valid_until` - Date and time of when the membership will become invalid\n";
        $doc .= "* `members` - An array representing each person associated with this membership. Fields include:\n";
        $doc .= "  * `id` - Unique identifier of this person on the membership\n";
        $doc .= "  * `member_type` - Number representing the type of member this person is\n";
        $doc .= "  * `primary` - Whether this person is the primary member\n";
        $doc .= "  * `status` - Number indicating the status of this person on the membership\n";
        $doc .= "  * `status_description` - Explanation of the status of this person on the membership\n";
        $doc .= "  * `relationship_type_id` - Unique identifier of the type of relationship this person has with the primary member\n";
        $doc .= "  * `relationship_description` - Explanation of the type of relationship this person has with the primary member\n";
        $doc .= "  * `job_title` - This person's job title\n";
        $doc .= "  * `name_title_id` - Unique identifier of this person's title, e.g., Ms., Miss, Mrs., Mr., etc.\n";
        $doc .= "  * `first_name` - This person's first name\n";
        $doc .= "  * `middle_name` - This person's middle name\n";
        $doc .= "  * `last_name` - This person's last name\n";
        $doc .= "  * `name_suffix_id` - Unique identifier of this person's suffix, e.g., Jr., III, etc.\n";
        $doc .= "  * `street_1` - First line of street address\n";
        $doc .= "  * `street_2` - Second line of street address, if needed\n";
        $doc .= "  * `street_3` - Third line of street address, if needed\n";
        $doc .= "  * `city` - The name of the city this person resides in\n";
        $doc .= "  * `state` - The name of the state this person resides in\n";
        $doc .= "  * `zip` - The zip code this person resides in\n";
        $doc .= "  * `country` - The name of the country this person resides in\n";
        $doc .= "  * `phone` - This person's phone number\n";
        $doc .= "  * `fax` - This person's fax number, if available\n";
        $doc .= "  * `cell` - This person's cell number, if available\n";
        $doc .= "  * `email` - This person's email address, if available\n";
        $doc .= "  * `allow_email` - Whether this person has stated it's okay to send them email\n";
        $doc .= "  * `allow_mailings` - Whether this person has stated it's okay to send them postal mailings\n";
        $doc .= "  * `date_of_birth` - Date this person was born\n";
        $doc .= "  * `age_group` - Number indicating this person's age group\n";
        $doc .= "  * `gender` - Number indicating this person's gender\n";

        $doc .= "\n\n";

        return $doc;
    }
}
