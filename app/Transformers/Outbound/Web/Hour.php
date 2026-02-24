<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class Hour extends BaseTransformer
{
    protected function getFields()
    {
        return [
            'monday_is_closed' => [
                'doc' => 'Whether the museum is closed on Mondays',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'monday_member_open' => [
                'doc' => 'The time member hours starts on Mondays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'monday_member_close' => [
                'doc' => 'The time member hours ends on Mondays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'monday_public_open' => [
                'doc' => 'The time public hours starts on Mondays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'monday_public_close' => [
                'doc' => 'The time public hours ends on Mondays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],

            'tuesday_is_closed' => [
                'doc' => 'Whether the museum is closed on Tuesdays',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'tuesday_member_open' => [
                'doc' => 'The time member hours starts on Tuesdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'tuesday_member_close' => [
                'doc' => 'The time member hours ends on Tuesdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'tuesday_public_open' => [
                'doc' => 'The time public hours starts on Tuesdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'tuesday_public_close' => [
                'doc' => 'The time public hours ends on Tuesdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],

            'wednesday_is_closed' => [
                'doc' => 'Whether the museum is closed on Wednesdays',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'wednesday_member_open' => [
                'doc' => 'The time member hours starts on Wednesdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'wednesday_member_close' => [
                'doc' => 'The time member hours ends on Wednesdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'wednesday_public_open' => [
                'doc' => 'The time public hours starts on Wednesdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'wednesday_public_close' => [
                'doc' => 'The time public hours ends on Wednesdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],

            'thursday_is_closed' => [
                'doc' => 'Whether the museum is closed on Thursdays',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'thursday_member_open' => [
                'doc' => 'The time member hours starts on Thursdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'thursday_member_close' => [
                'doc' => 'The time member hours ends on Thursdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'thursday_public_open' => [
                'doc' => 'The time public hours starts on Thursdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'thursday_public_close' => [
                'doc' => 'The time public hours ends on Thursdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],

            'friday_is_closed' => [
                'doc' => 'Whether the museum is closed on Fridays',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'friday_member_open' => [
                'doc' => 'The time member hours starts on Fridays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'friday_member_close' => [
                'doc' => 'The time member hours ends on Fridays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'friday_public_open' => [
                'doc' => 'The time public hours starts on Fridays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'friday_public_close' => [
                'doc' => 'The time public hours ends on Fridays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],

            'saturday_is_closed' => [
                'doc' => 'Whether the museum is closed on Saturdays',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'saturday_member_open' => [
                'doc' => 'The time member hours starts on Saturdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'saturday_member_close' => [
                'doc' => 'The time member hours ends on Saturdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'saturday_public_open' => [
                'doc' => 'The time public hours starts on Saturdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'saturday_public_close' => [
                'doc' => 'The time public hours ends on Saturdays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],

            'sunday_is_closed' => [
                'doc' => 'Whether the museum is closed on Sundays',
                'type' => 'boolean',
                'elasticsearch' => 'boolean',
            ],
            'sunday_member_open' => [
                'doc' => 'The time member hours starts on Sundays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'sunday_member_close' => [
                'doc' => 'The time member hours ends on Sundays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'sunday_public_open' => [
                'doc' => 'The time public hours starts on Sundays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'sunday_public_close' => [
                'doc' => 'The time public hours ends on Sundays',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'summary' => [
                'doc' => 'Readable summary of the hours',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],
            'additional_text' => [
                'doc' => 'Additional information about the hours',
                'type' => 'string',
                'elasticsearch' => 'text',
            ],

        ];
    }
}
