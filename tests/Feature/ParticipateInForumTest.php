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
        $this->withExceptionHandling();
        $response = $this->post('/threads/some-channel/1/replies', []);
        $response->assertRedirect('/login');
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

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->withExceptionHandling();
        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);
        $this->post($thread->path().'/replies', $reply->toArray())
             ->assertSessionHasErrors('body');
    }


}
