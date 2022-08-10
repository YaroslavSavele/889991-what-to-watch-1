<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Film;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentModelTest extends TestCase
{
    use RefreshDatabase;

    public function testGetUserName()
    {
        $user = User::factory()->create();
        $film = Film::factory()->create();
        $name = $user->name;

        $comment = Comment::factory()->create();
        $userName = $comment->user->name;

        $this->assertEquals($name, $userName);
    }

    public function testGetAnonymous()
    {
        $user = User::factory()->create();
        $film = Film::factory()->create();
        $comment = Comment::factory()->create();

        $user->delete();
        $userName = $comment->user->name;

        $this->assertEquals('Anonymous', $userName);
    }
}
