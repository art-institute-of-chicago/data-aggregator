<?php

namespace App\Transformers\Inbound\Web;

use Ramsey\Uuid\Uuid;
use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class EventOccurrence extends WebTransformer
{
    public static $sourceLastUpdateDateField = 'updated_at';

    protected $passthrough = true;

    /**
     * When this namespace is specified, the name string is an event occurrence.
     * This is just a version 4 UUID (i.e. random). No reason we can't change it later!
     * @link https://stackoverflow.com/questions/10867405/generating-v5-uuid-what-is-name-and-namespace
     * @link https://uuid.ramsey.dev/en/latest/rfc4122/version5.html
     */
    const UUID_NAMESPACE = '39cb3cac-c8ec-4b8f-9326-56c0e838056c';

    protected function getIds(Datum $datum)
    {
        return [
            'id' => Uuid::uuid5(self::UUID_NAMESPACE, $datum->id . '/' . $datum->date('start_at')),
            'event_id' => $datum->id,
        ];
    }

    protected function getDates(Datum $datum)
    {
        return array_merge(
            parent::getDates($datum),
            [
                'source_updated_at' => $datum->date('updated_at'),
            ]
        );
    }

    protected function getExtraFields(Datum $datum)
    {
        return [
            'event_id' => $datum->id,
            'start_at' => $datum->datetime('start_at'),
            'end_at' => $datum->datetime('end_at'),
            // TODO: Fix ellipsis issue upstream [WEB-507]
            'image_caption' => $datum->image_caption ? html_entity_decode($datum->image_caption) : null,
        ];
    }
}
