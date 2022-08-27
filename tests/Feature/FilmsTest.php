<?php

namespace Tests\Feature;

use App\Jobs\AddFilm;
use App\Models\Film;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Laravel\Sanctum\Sanctum;
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

    public function testRequestAddingFilm()
    {
        Queue::fake();

        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson(route('films.store'), ['imdb' => 'tt0944947']);

        Queue::assertPushed(AddFilm::class);

        $response->assertStatus(201);
    }

    public function testValidationExistsErrorForAddingFilm()
    {
        $film = Film::factory()->create(['imdb_id' => 'tt0944947']);

        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson(route('films.store'), ['imdb' => $film->imdb_id]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['imdb']]);
        $response->assertJsonFragment(['imdb' => ['Такой фильм уже есть']]);
    }

    public function testValidationFormatErrorForAddingFilm()
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson(route('films.store'), ['imdb' => '944947']);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['imdb']]);
        $response->assertJsonFragment(['imdb' => ['imdb id должен быть передан в формате ttNNNN']]);
    }

    public function testAuthErrorForAddingFilm()
    {

        $response = $this->postJson(route('films.store'), ['imdb' => 'tt0944947']);

        $response->assertStatus(401);
        $response->assertJsonFragment(['message' => 'Unauthenticated.']);
    }
}
