<?php

namespace App\Models\Membership;

use App\Models\MembershipModel;

use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

/**
 * An occurrence of a program at the museum.
 */
class TicketedEventType extends MembershipModel
{

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [

            [
                "name" => 'category',
                "doc" => "The category of this event type",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->category; },
            ],
            [
                "name" => 'description',
                "doc" => "Description of this event type",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return $this->description; },
            ],

        ];

    }

}
