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
class Event extends MembershipModel
{

    use ElasticSearchable;
    use Documentable;

    protected $dates = [
        'start_at',
        'end_at',
        'source_created_at',
        'source_modified_at',
    ];

    public function exhibitions()
    {

        return $this->belongsToMany('App\Models\Collections\Exhibition');

    }

    public function resource2gallery( $resource_id )
    {

        $locations = [
            '3' => 26131, // Rubloff Auditorium
            '4' => 28277, // Price Auditorium
            '5' => 28276, // Morton Auditorium
            '10' => 24000, // Griffin Court
            '11' => 2147475902, // Regenstein Hall
            '22' => 23998, // Abbott Galleries (Galleries 182-184, this is Gallery 183)
            '23' => 2147483599, // Fullerton Hall
            '49' => 23965, // Cafe Moderno
            '50' => 25563, // Terzo Piano
            '77' => 2147475902, // Regenstein Hall Thursday
            '80' => 25237, // Pritzker Garden
            '81' => 346, // Stock Exchange Trading Room
            '82' => 2147477257, // Gallery 11
            '83' => 2147472011, // Grand Staircase
            '86' => 27946, // South Garden
            '87' => 2147477076, // North Garden
        ];

        $resource_id = (string) $resource_id;

        return $locations[ $resource_id ] ?? null;
    }

    protected function getFillFieldsFrom($source)
    {

        if ($source->source = 'drupal')
        {

            //// Available fields we haven't done anything with yet:
            // +"summary": " Guided tour  "
            // +"url": "http://www.artic.edu/event/gallery-talk-modern-wing-highlights"
            // Once we know more about what the types are from Galaxy, store types for non-Galaxy events
            //$this->printUnknown($this->drupalTypeValues(), $source->type);

            $ret = [
                'title' => $source->title,
                'description' => $source->body,
                'image_url' => $source->image,
                'source_created_at' => new Carbon($source->created_at),
                'source_modified_at' => new Carbon($source->modified_at),
                'is_ticketed' => FALSE,
            ];

            if (!$this->start_at)
            {

                $ret['start_at'] = new Carbon($source->dates ." " .$source->start_time);

            }
            if (!$this->end_at)
            {

                $ret['end_at'] = new Carbon($source->dates ." " .$source->end_time);

            }
            if (!$this->resource_title)
            {

                $ret['resource_title'] = $source->location;

            }
            if (!$this->is_admission_required)
            {

                // Set flag is_admission_required
                $ret['is_admission_required'] = FALSE;
                if ($source->fee == "Free with museum admission"
                    || $source->fee == "Free with museum admission*"
                    || $source->fee == "Free with museum admission, no registration required"
                    || $source->fee == "Free with museum admission; registration required"
                    || $source->fee == "Free with museum admission, registration required"
                    || $source->fee == "Free with museum admission; registration required*"
                    || $source->fee == "Free to Illinois residents or with museum admission; registration required*") {

                    $ret['is_admission_required'] = TRUE;

                }

            }

            return $ret;

        }
        else
        {

            return [

                'membership_id' => $source->id,

                'type_id' => $source->type_id,

                'start_at' => strtotime($source->start_at),
                'end_at' => strtotime($source->end_at),

                'resource_id' => $source->resource_id,
                'resource_title' => $source->resource_title,

                'is_after_hours' => $source->is_after_hours,
                'is_private_event' => $source->is_private_event,
                'is_admission_required' => $source->is_admission_required,

                'available' => $source->available,
                'total_capacity' => $source->total_capacity,

                'is_ticketed' => $source->is_ticketed,

            ];

        }

    }

    public function attachFrom($source)
    {

        if ($source->exhibition_id)
        {

            $ids = explode(', ', $source->exhibition_id);
            $syncIds = [];
            foreach ($ids as $id)
            {
                if ($this->exhibitionIdFromDrupal($id)) {
                    $syncIds[] = $this->exhibitionIdFromDrupal($id);
                }
            }
            $this->exhibitions()->sync($syncIds, false);

        }

        return $this;

    }

    /**
     * Specific field definitions for a given class. See `transformMapping()` for more info.
     */
    protected function transformMappingInternal()
    {

        return [

            'type_id' => [
                "doc" => "Number indicating the type of event",
                "type" => "number",
                "value" => function() { return $this->type_id; },
            ],

            'start_at' => [
                "doc" => "Date and time the event begins",
                "type" => "ISO 8601 date and time",
                "value" => function() { return $this->start_at ? $this->start_at->toIso8601String() : NULL; },
            ],
            'end_at' => [
                "doc" => "Date and time the event ends",
                "type" => "ISO 8601 date and time",
                "value" => function() { return $this->end_at ? $this->end_at->toIso8601String() : NULL; },
            ],

            'resource_id' => [
                "doc" => "Unique identifier of the resource associated with this event, often the venue in which it takes place",
                "type" => "number",
                "value" => function() { return $this->resource_id; },
            ],
            'resource_title' => [
                "doc" => "The name of the resource associated with this event, often the venue in which it takes place",
                "type" => "number",
                "value" => function() { return $this->resource_title; },
            ],

            // Caution: (bool) null = false
            // TODO: Use $casts throughout the codebase
            'is_after_hours' => [
                "doc" => "Whether the event takes place after museum hours",
                "type" => "boolean",
                "value" => function() { return (bool) $this->is_after_hours; },
            ],
            'is_private_event' => [
                "doc" => "Whether the event is open to public",
                "type" => "boolean",
                "value" => function() { return (bool) $this->is_private_event; },
            ],
            'is_admission_required' => [
                "doc" => "Whether admission is required in order to attend the event",
                "type" => "boolean",
                "value" => function() { return (bool) $this->is_admission_required; },
            ],

            'available' => [
                "doc" => "Number indicating how many tickets are available for the event",
                "type" => "number",
                "value" => function() { return $this->available; },
            ],
            'total_capacity' => [
                "doc" => "Number indicating the total number of tickets that can be sold for the event",
                "type" => "number",
                "value" => function() { return $this->total_capacity; },
            ],
            'is_ticketed' => [
                "doc" => "Whether a ticket is required to attend the event.",
                "type" => "boolean",
                "value" => function() { return (bool) $this->is_ticketed; },
            ],

        ];

    }


    /**
     * Generate model-specific fields for an array representing the schema for this object.
     *
     * @return array
     */
    public function elasticsearchMappingFields()
    {

        return [

            'type_id' => [
                'type' => 'keyword',
            ],
            'start_at' => [
                'type' => 'date',
            ],
            'end_at' => [
                'type' => 'date',
            ],
            'resource_id' => [
                'type' => 'integer',
            ],
            'resource_title' => [
                'type' => 'keyword',
            ],
            'is_after_hours' => [
                'type' => 'boolean',
            ],
            'is_private_event' => [
                'type' => 'boolean',
            ],
            'is_admission_required' => [
                'type' => 'boolean',
            ],
            'available' => [
                'type' => 'integer',
            ],
            'total_capacity' => [
                'type' => 'integer',
            ],
            'is_ticketed' => [
                'type' => 'boolean',
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

        return "14156";

    }

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

    public function printUnknown($knownValues, $val)
    {

        if ($val && !in_array(trim($val), $knownValues))
        {
            Log::warning($val);
        }

    }

    public function exhibitionIdFromDrupal($title)
    {

        switch ($title) {
        case 'Rodin: Sculptor and Storyteller':
        case 7590:
            return 2756;
            break;
        case 'Making Memories: Quilts as Souvenirs':
        case 7435:
            return 2954;
            break;
        case 'Dress Codes: Portrait Photographs from the Collection':
        case 7593:
            return 2959;
            break;
        case 'Andrew Lord: Unslumbrous Night':
        case 7437:
            return 2956;
            break;
        case 'Shockingly Mad: Henry Fuseli and the Art of Drawing':
        case 7592:
            return 2945;
            break;
        case 'Revoliutsiia! Demonstratsiia! Soviet Art Put to the Test':
        case 7436:
            return 2514;
            break;
        case 'Tarsila do Amaral: Inventing Modern Art in Brazil':
        case 7434:
            return 2345;
            break;
        case 'Doctrine and Devotion: Art of the Religious Orders in the Spanish Andes':
        case 6174:
            return 2493;
            break;
        case 'India Modern: The Paintings of M. F. Husain':
        case 7320:
            return 2772;
            break;
        case 'Past Forward: Architecture and Design at the Art Institute':
        case 7438:
            return 5393;
            break;
        case 'Leigh Ledare: The Plot—Ruttenberg Contemporary Photography Series':
        case 7420:
            return 2951;
            break;
        case 'City and Country: Views of Urban and Rural Japan by Modern Japanese Artists':
        case 1425:
            return 8878;
            break;
        case 'Neapolitan Crèche':
        case 6670:
            return 3110;
            break;
        case 'Elizabeth Price':
        case 7623:
            return 2955;
            break;
        }

        return 0;
    }

}
