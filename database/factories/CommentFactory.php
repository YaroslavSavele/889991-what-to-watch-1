<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Film;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;


    public function definition()
    {
        return [
            'text' => $this->faker->sentences(3, true),
            'rating' => random_int(1, 10),
            'user_id' => User::inRandomOrder()->first()->id,
            'film_id' => Film::inRandomOrder()->first()->id,
        ];
    }
}
