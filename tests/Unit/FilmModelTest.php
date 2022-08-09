<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Film;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilmModelTest extends TestCase
{
    use RefreshDatabase;

    public function testGetRating()
    {
        $user = User::factory()->create();
        $film = Film::factory()->hasComments(3)->create();
        $rating = $film->getRating();


        $this->assertEquals(5, $rating);
    }


}
