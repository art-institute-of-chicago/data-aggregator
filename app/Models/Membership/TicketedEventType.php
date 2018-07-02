<?php

namespace App\Models\Membership;

use App\Models\MembershipModel;
use App\Models\ElasticSearchable;
use App\Models\Documentable;

use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

/**
 * An occurrence of a program at the museum.
 */
class TicketedEventType extends MembershipModel
{

    use ElasticSearchable;
    use Documentable;

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


    /**
     * Get an example ID for documentation generation
     *
     * @return string
     */
    public function exampleId()
    {

        return "2";

    }

}
