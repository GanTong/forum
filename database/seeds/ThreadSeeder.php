<?php

use Illuminate\Database\Seeder;
use App\Thread;
use App\Channel;
use App\Reply;
use App\User;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Thread::truncate();
        Reply::truncate();
        User::truncate();
        Channel::truncate();

        $user = factory('App\User')->create(['name' => 'tong']);

        $thread = factory(Thread::class)->create([
            'user_id' => $user->id,

            'channel_id' => function () {
                return factory('App\Channel')->create([
                    'name' => 'php',
                    'slug' => 'php'
                ]);
            },

            'title' => 'some php post',
            'body' => 'this is the body',

        ]);


        factory(Reply::class)->create([

            'thread_id' => $thread->id,
            'user_id' => $user->id,
            'body' => 'this is some reply to user tong',

        ]);
    }
}
