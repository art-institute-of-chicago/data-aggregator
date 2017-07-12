<?php

namespace App\Membership;

class Member extends MembershipModel
{

    protected $dates = ['source_created_at', 'source_modified_at', 'source_indexed_at', 'opened_at', 'used_at', 'expires_at'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

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
