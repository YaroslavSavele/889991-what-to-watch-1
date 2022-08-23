<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    use HasFactory;

    protected $withCount = ['comments'];
//    protected $with = ['genres'];

    protected $fillable = [
        'name',
        'poster_image',
        'preview_image',
        'background_image',
        'background_color',
        'video_link',
        'description',
        'run_time',
        'released',
        'imdb_id',
        'status',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'actor_films');
    }

    public function directors()
    {
        return $this->belongsToMany(Director::class, 'director_films');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'film_users');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'film_genres');
    }

    public function getRating()
    {
        $count = $this->comments()->count();
        $sum = $this->comments()->sum('rating');

        return $sum / $count;
    }
}
