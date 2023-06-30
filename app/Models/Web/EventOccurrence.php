<?php

namespace App\Models\Web;

use Ramsey\Uuid\Uuid;
use App\Models\WebModel;

/**
 * An occurrence of an event on the website
 */
class EventOccurrence extends WebModel
{
    protected $keyType = 'string';

    protected $casts = [
        'is_private' => 'boolean',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function event()
    {
        return $this->belongsTo('App\Models\Membership\Event');
    }

    public static function validateId($id)
    {
        return Uuid::isValid($id);
    }
}
