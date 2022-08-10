<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Film::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'video_link' => $this->faker->Url(),
            'description' => $this->faker->text,
            'run_time' => random_int(10, 200),
            'released' => $this->faker->year,
            'imdb_id' => $this->faker->word,
            'status' => $this->faker->randomElement(['pending','on moderation','ready']),
        ];
    }
}
