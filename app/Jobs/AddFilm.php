<?php

namespace App\Jobs;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Film;
use App\Models\Genre;
use App\Services\MovieInfoGetter;
use App\Services\OmdRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddFilm implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $imdbId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($imdbId)
    {
        $this->imdbId = $imdbId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(InterfaceMovieRepository $repository)
    {
        $movieInfoGetter = new MovieInfoGetter();
        $info = $movieInfoGetter->getArrayInfo($repository->getMovie($this->imdbId));
        $data = $info[0];

        if ($data) {
            list('Genre' => $genres, 'Director' => $directors, 'Actors' => $actors, 'Released' => $released) = $data;
            $genres = explode(", ", $genres);
            $directors = explode(", ", $directors);
            $actors = explode(", ", $actors);
            $yearReleased = date("Y", strtotime($released));

            $genresId = [];
            $directorsId = [];
            $actorsId = [];

            foreach ($genres as $genre) {
                $genresId = Genre::firstOrCreate(['name' => $genre])->id;
            }

            foreach ($directors as $director) {
                $directorsId = Director::firstOrCreate(['name' => $director])->id;
            }

            foreach ($actors as $actor) {
                $actorsId = Actor::firstOrCreate(['name' => $actor])->id;
            }

            $film = Film::create([
                'name' => $data['Title'],
                'poster_image' => $data['Poster'],
                'description' => $data['Plot'],
                'run_time' => intval($data['Runtime']),
                'released' => $yearReleased,
                'imdb_id' => $data['imdbID'],
                'status' => 'pending',
            ]);

            $film->genres()->attach($genresId);
            $film->directors()->attach($directorsId);
            $film->actors()->attach($actorsId);
        }
    }
}
