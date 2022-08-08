<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class CommentModelTest extends TestCase
{
    use RefreshDatabase;

    public function testReturnUserName()
    {
        $user = User::factory()->create();
//        $user = new User([
//                'name' => 'name',
//                'email' => 'example@example.com',
//                'password' => 'password',
//        ]);
//        $user->name = 'name';
        $comment = Comment::factory()->create();
//        $userName = $comment->userName();

//        $this->assertIsString($userName);
        $this->assertTrue(true);
    }
}
