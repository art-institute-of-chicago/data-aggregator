<?php

namespace App\Models\Web;

use App\Models\AbstractPivot as BasePivot;

class EventEmailSeriesPivot extends BasePivot
{

    public $incrementing = false;

    protected $table = 'event_email_series';

    protected $casts = [
        'send_affiliate_test' => 'boolean',
        'send_member_test' => 'boolean',
        'send_sustaining_fellow_test' => 'boolean',
        'send_nonmember_test' => 'boolean',
    ];

    public function event()
    {
        return $this->belongsTo('App\Models\Web\Event', 'event_id', 'id');
    }

    public function emailSeries()
    {
        return $this->belongsTo('App\Models\Web\EmailSeries', 'email_series_id', 'id');
    }

}
