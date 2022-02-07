<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{

    use DatabaseMigrations;



    public function test_unauthenticated_users_may_not_add_replies()
    {

        $this->expectException('Illuminate\Auth\AuthenticationException');


        $this->post(  '/threads/1/replies', []);

    }

    public function test_an_authenticated_user_may_participate_in_forum_threads()
    {

        $this->be(User::factory()->create());

        $thread = Thread::factory()->create();

        $reply = Reply::factory()->create();


        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())->assertSee($reply->body);
    }
}
