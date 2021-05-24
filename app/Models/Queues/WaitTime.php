<?php

namespace App\Models\Queues;

use App\Models\BaseModel;

/**
 * The wait time for a specific queue.
 */
class WaitTime extends BaseModel
{

    public static $aicQueueIds = [
        18146 => 'Bisa Butler – Member',
        18122 => 'Bisa Butler – GA',
        18147 => 'Monet – Member',
        18121 => 'Monet – GA',
    ];

    protected $primaryKey = 'queue_id';
}
