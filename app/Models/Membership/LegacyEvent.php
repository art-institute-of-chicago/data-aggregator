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
class LegacyEvent extends MembershipModel
{

    use ElasticSearchable;
    use Documentable;

    public function exhibitions()
    {

        return $this->belongsToMany('App\Models\Collections\Exhibition', 'legacy_event_exhibition', 'legacy_event_membership_id', 'exhibition_citi_id');

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [

            [
                "name" => 'description',
                "doc" => "Long description of the event",
                "type" => "string",
                "elasticsearch" => [
                    "default" => true,
                    "type" => 'text',
                ],
                "value" => function() { return $this->description ?: null; },
            ],
            [
                "name" => 'short_description',
                "doc" => "Short description of the event",
                "type" => "string",
                'elasticsearch_type' => 'text',
                "value" => function() { return trim($this->short_description) ?: null; },
            ],
            [
                "name" => 'image',
                "doc" => "URL to an image representing this event",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->image_url ?: null; },
            ],
            [
                "name" => 'type',
                "doc" => "The name of the type of event",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->type ?: null; },
            ],
            [
                "name" => 'start_at',
                "doc" => "Date and time the event begins",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->start_at ? $this->start_at->toIso8601String() : null; },
            ],
            [
                "name" => 'end_at',
                "doc" => "Date and time the event ends",
                "type" => "ISO 8601 date and time",
                'elasticsearch_type' => 'date',
                "value" => function() { return $this->end_at ? $this->end_at->toIso8601String() : null; },
            ],
            [
                "name" => 'location',
                "doc" => "Location of the event (freetext)",
                "type" => "string",
                "value" => function() { return $this->resource_title ?: null; },
            ],
            [
                "name" => 'exhibition_ids',
                "doc" => "Unique identifiers of the exhibitions associated with this work",
                "type" => "array",
                'elasticsearch_type' => 'integer',
                "value" => function() { return $this->exhibitions->pluck('citi_id')->all(); },
            ],
            [
                "name" => 'button_text',
                "doc" => "Name of text on the CTA to buy tickets/register",
                "type" => "string",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->button_text; },
            ],
            [
                "name" => 'button_url',
                "doc" => "URL of the CTA to buy tickets/register",
                "type" => "url",
                'elasticsearch_type' => 'keyword',
                "value" => function() { return $this->button_url; },
            ],

        ];

    }


    public function searchableImage()
    {

        return $this->image_url;

    }

    /**
     * Currently unused?
     */
    public function drupalFeeValues()
    {

        return [
            "Free",
            "Free with museum admission",
            "Free with museum admission*",
            "Free with museum admission, no registration required",
            "Free with museum admission; registration required",
            "Free with museum admission, registration required",
            "Free with museum admission; registration required*",
            "Free; No registration required",
            "Free, no registration required",
            "Free for members; no registration required",
            "Free ticket required",
            "Free; registration required",
            "Free to Illinois residents or with museum admission; registration required*",
            "Registration required",
        ];

    }

    /**
     * Currently unused?
     */
    public function drupalTypeValues()
    {

        return [
            "Family Program",
            "Talks",
            "Member Exclusive",
            "Classes and Workshops",
            "Live Arts",
            "Screenings",
            "Special Events",
        ];

    }

    /**
     * Currently unused?
     */
    public function printUnknown($knownValues, $val)
    {

        if ($val && !in_array(trim($val), $knownValues))
        {
            Log::warning($val);
        }

    }

}
