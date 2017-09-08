<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{

    protected $dates = ['last_attempt_at', 'last_success_at'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Accessor function to ease date comparison.
     *
     * @param string $value
     * @var \Carbon\Carbon;
     */
    public function getLastSuccessAtAttribute($value)
    {
        return $value ? new Carbon($value) : self::never();
    }

    /**
     * Functional value for a "never" Carbon date. Enables date comparison.
     *
     * @return \Carbon\Carbon;
     */
    public static function never()
    {
        return Carbon::createFromTimestampUTC(1);
    }

}
