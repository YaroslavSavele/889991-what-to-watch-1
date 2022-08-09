<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function directors()
    {
        return $this->belongsToMany(Director::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function getRating()
    {
        $count = $this->comments()->count();
        $sum = $this->comments()->sum('rating');

        return $sum / $count;
    }
}
