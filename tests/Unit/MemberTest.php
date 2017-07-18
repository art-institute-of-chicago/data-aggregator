<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Membership\Member;

class MemberTest extends ApiTestCase
{

    /** @test */
    public function it_fetches_a_single_member()
    {

        $this->it_fetches_a_single(Member::class, 'members', '60647');

    }

    /** @test */
    public function it_400s_if_nonnumerid_nonuuid_is_passed()
    {

        $this->it_400s(Member::class, 'events');

    }

    /** @test */
    public function it_403s_if_limit_is_too_high()
    {

        $this->it_403s(Member::class, 'events');

    }

    /** @test */
    public function it_404s_if_not_found()
    {

        $this->it_404s(Member::class, 'events');

    }

    /** @test */
    public function it_405s_if_a_request_is_posted()
    {

        $this->it_405s(Member::class, 'events');

    }

}
