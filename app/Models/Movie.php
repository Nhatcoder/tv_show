<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'movie';
    public $primaryKey = 'id';

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function movie_genre()
    {
        return $this->belongsToMany(Genre::class, 'movie_genre', 'id_movie', 'id_genre');
    }

    public function episode()
    {
        return $this->hasMany(Episode::class, 'id_movie');
    }
}
