<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function unauthenticated_users_may_not_add_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->post('/threads/some-channel/1/replies', []);
    }
    
    
    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
         $this->signIn();

         $thread = create('App\Thread');
         $reply = create('App\Reply');
         $this->post($thread->path().'/replies', $reply->toArray());

         $response = $this->get($thread->path());
         $response->assertSee($reply->body);
    }


}
