<?php

namespace App\Membership;

class Member extends MembershipModel
{

    protected $dates = ['api_created_at', 'api_modified_at', 'api_indexed_at', 'opened_at', 'used_at', 'expires_at'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['membership_id', 'title'];

    /**
     * Override `find` method
     */
    public function __call($method, $parameters)
    {
        if ($method == 'find') {
            
            return factory(get_class())->make();

        }

        return parent::__call($method, $parameters);
    }
}
