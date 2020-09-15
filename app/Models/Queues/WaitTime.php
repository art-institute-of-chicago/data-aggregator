<?php

namespace App\Models\Queues;

use App\Models\BaseModel;

/**
 * The wait time for a specific queue.
 */
class WaitTime extends BaseModel
{

    public static $aicQueueIds = [
        1980 => 'El Greco – Member',
        1981 => 'El Greco – GA',
        1982 => 'Monet – Member',
        1983 => 'Monet – GA',
    ];

    protected $primaryKey = 'queue_id';
}
