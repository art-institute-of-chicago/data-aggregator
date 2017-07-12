<?php

namespace App\Membership;

use Illuminate\Database\Eloquent\Model;

class MembershipModel extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'membership_id';
    protected $dates = ['source_created_at', 'source_modified_at'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
