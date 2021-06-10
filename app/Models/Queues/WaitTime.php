<?php

namespace App\Models\Queues;

use App\Models\BaseModel;

/**
 * The wait time for a specific queue.
 */
class WaitTime extends BaseModel
{

    public static $aicQueueIds = [
        18146 => 'Bisa Butler (18146)',
        18147 => 'Monet (18147)',
    ];

    protected $primaryKey = 'queue_id';
}
