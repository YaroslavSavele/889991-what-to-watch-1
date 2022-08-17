<?php

namespace Tests\Feature;

use App\Models\Film;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilmsTest extends TestCase
{
    use RefreshDatabase;

    public function testGetFilmsList()
    {
        $count = random_int(2, 10);
        Film::factory()->count($count)->create();

        $response = $this->getJson(route('films.index'));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [], 'links' => [], 'total']);
        $response->assertJsonFragment(['total' => $count]);
    }

    public function testGetOneFilm()
    {
        $film = Film::factory()->create();

        $response = $this->getJson(route('films.show', $film->id));

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $film->name,
            'video_link' => $film->video_link,
            'description' => $film->description,
            'run_time' => $film->run_time,
            'released' => $film->released,
            'imdb_id' => $film->imdb_id,
            'status' => $film->status,
        ]);
    }
}
