<?php

namespace App\Models\Collections;

use App\Models\Fillable;
use App\Models\Instancable;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * A venue in which an exhibition took place
 */
class AgentExhibition extends Pivot
{

    use Fillable, Instancable;

    public $timestamps = false;
    protected $dates = ['date_start', 'date_end'];

    public function getExtraFillFieldsFrom($source)
    {

        return [
            'agent_citi_id' => $source->agent_id,
            'date_start' => $source->start_date ? strtotime($source->start_date) : null,
            'date_end' => $source->end_date ? strtotime($source->end_date) : null,
        ];

    }

}