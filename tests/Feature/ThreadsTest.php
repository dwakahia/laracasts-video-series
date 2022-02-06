<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;


    public function setUp(): void
    {
        parent::setUp();

        $this->thread = Thread::factory()->create();
    }


    public function test_user_can_browse_threads()
    {


        $response = $this->get('/threads')->assertSee($this->thread->title);

    }

    public function test_user_can_read_a_single_thread()
    {

        $response = $this->get('/threads/' . $this->thread->id)->assertSee($this->thread->title);
    }

    public function test_a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = Reply::factory()->create(['thread_id' => $this->thread->id]);

        $this->get('/threads/' . $this->thread->id)->assertSee($reply->body);

    }
}
