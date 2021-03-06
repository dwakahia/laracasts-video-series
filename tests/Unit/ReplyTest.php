<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    public function test_has_owner()
    {
        $reply = Reply::factory()->create();


        $this->assertInstanceOf(User::class, $reply->owner);
    }
}
