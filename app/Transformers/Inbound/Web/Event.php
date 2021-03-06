<?php

namespace App\Transformers\Inbound\Web;

use App\Transformers\Datum;
use App\Transformers\Inbound\WebTransformer;

class Event extends WebTransformer
{

    protected function getExtraFields(Datum $datum)
    {
        return [
            'start_date' => $datum->datetime('start_date'),
            'end_date' => $datum->datetime('end_date'),
            'type' => $datum->event_type,
            'test_emails' => $this->getTestEmails($datum),

            // TODO: Move these to trait?
            'publish_start_date' => $datum->date('publish_start_date'),
            'publish_end_date' => $datum->date('publish_end_date'),
        ];
    }

    protected function getSync(Datum $datum, $test = false)
    {
        return [
            'emailSeries' => $this->getSyncEmailSeries($datum),
        ];
    }

    private function getTestEmails(Datum $datum)
    {
        return array_map('trim', array_filter(explode(',', rtrim($datum->test_emails, ','))));
    }

    private function getSyncEmailSeries(Datum $datum)
    {
        return $this->getSyncPivots($datum, 'email_series', 'email_series_id', function ($pivot) {
            return [
                $pivot->email_series_id => array_intersect_key((new Datum($pivot))->all(), array_flip([
                    'affiliate_copy',
                    'member_copy',
                    'luminary_copy',
                    'nonmember_copy',
                    'send_affiliate_test',
                    'send_member_test',
                    'send_luminary_test',
                    'send_nonmember_test',
                ])),
            ];
        });
    }
}
