<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;
    // public $timestamps = false;
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

    public static function searchMovieAdmin($search = "", $category_id = "")
    {
        $query = self::query();
        $query->select('movie.*')
            ->where('movie.status', 1);

        if (!empty(Request::get('search'))) {
            $query->where('movie.name', 'like', '%' . $search . '%');
        }

        if (!empty(Request::get('category_id'))) {
            $query->where('movie.id_category', $category_id);
        }

        $query->leftJoin('episode', 'movie.id', '=', 'episode.id_movie')
            ->selectRaw('movie.*, COUNT(episode.id) as episode_count')
            ->groupBy('movie.id')
            ->orderBy('movie.id', 'desc');

        return $query->get();
    }
}
