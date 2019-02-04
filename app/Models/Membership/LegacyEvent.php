<?php

namespace App\Models\Membership;

use App\Models\MembershipModel;
use App\Models\ElasticSearchable;

use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

/**
 * An occurrence of a program at the museum.
 */
class LegacyEvent extends MembershipModel
{

    use ElasticSearchable;

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function exhibitions()
    {

        return $this->belongsToMany('App\Models\Collections\Exhibition', 'legacy_event_exhibition', 'legacy_event_membership_id', 'exhibition_citi_id');

    }

    public function searchableImage()
    {

        return $this->image_url;

    }

}
