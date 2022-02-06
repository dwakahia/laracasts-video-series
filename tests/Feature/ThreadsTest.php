<?php

namespace Tests\Feature;

use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;


    public function test_user_can_browse_threads()
    {

       $thread = Thread::factory()->create();

        $response = $this->get('/threads');

        $response->assertSee($thread->title);

        $response = $this->get('/threads/'.$thread->id);
        $response->assertSee($thread->title);
    }

    public function test_user_can_read_a_single_thread()
    {

        $thread = Thread::factory()->create();

        $response = $this->get('/threads/'.$thread->id);

        $response->assertSee($thread->title);
    }
}
