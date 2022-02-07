<?php

namespace Tests\Unit;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadTest extends TestCase
{

    use DatabaseMigrations;

    private $thread;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = Thread::factory()->create();
    }


    public function test_a_thread_has_replies()
    {

        $this->assertInstanceOf(Collection::class, $this->thread->replies);
    }

    public function test_a_thread_has_a_creator()
    {
        $this->assertInstanceOf(User::class, $this->thread->creator);
    }

    public function test_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
}
