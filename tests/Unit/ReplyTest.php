<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function reply_has_an_owner_associated_to_a_particular_thread()
    {
        $reply = create('App\Reply');

        $this->assertInstanceOf('App\User', $reply->owner);

    }


}
