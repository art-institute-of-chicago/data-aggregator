<?php

namespace App\Http\Transformers;

use App\Models\Membership\TicketedEvent;

class TicketedEventTransformer extends ApiTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'event',
    ];


    /**
     * Include events.
     *
     * @param  \App\Models\Membership\TicketedEvent  $ticketedEvent
     * @return League\Fractal\ItemResource
     */
    public function includeEvent(TicketedEvent $ticketedEvent)
    {
        return $ticketedEvent->event ? $this->item($ticketedEvent->event, new ApiTransformer, false) : NULL;
    }

}
