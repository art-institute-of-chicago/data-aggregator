<?php

namespace App\Transformers\Outbound\Web;

use App\Transformers\Outbound\Collections\Traits\HidesDefaultFields;

use App\Transformers\Outbound\AbstractTransformer as BaseTransformer;

class EventEmailSeriesPivot extends BaseTransformer
{
    use HidesDefaultFields;

    protected function getFields()
    {
        return [
            'event_id' => [
                'doc' => 'Unique identifier of the event associated with this pivot',
                'type' => 'number',
                'value' => function ($item) {
                    return $item->event->id ?? null;
                },
            ],
            'email_series_id' => [
                'doc' => 'Unique identifier of the email series associated with this pivot',
                'type' => 'number',
                'value' => function ($item) {
                    return $item->emailSeries->id ?? null;
                },
            ],
            'affiliate_copy' => [
                'doc' => 'Copy to use for Affiliate Members when communicating this event in this email series',
                'type' => 'string',
            ],
            'member_copy' => [
                'doc' => 'Copy to use for Members when communicating this event in this email series',
                'type' => 'string',
            ],
            'luminary_copy' => [
                'doc' => 'Copy to use for Luminary when communicating this event in this email series',
                'type' => 'string',
            ],
            'nonmember_copy' => [
                'doc' => 'Copy to use for Non-Members when communicating this event in this email series',
                'type' => 'string',
            ],
            'send_affiliate_test' => [
                'doc' => 'Whether to send the Affiliate Members test email during next check',
                'type' => 'boolean',
            ],
            'send_member_test' => [
                'doc' => 'Whether to send the Members test email during next check',
                'type' => 'boolean',
            ],
            'send_luminary_test' => [
                'doc' => 'Whether to send the Luminary test email during next check',
                'type' => 'boolean',
            ],
            'send_nonmember_test' => [
                'doc' => 'Whether to send the Non-Members test email during next check',
                'type' => 'boolean',
            ],
        ];
    }
}
