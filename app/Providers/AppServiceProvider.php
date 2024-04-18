<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_genre;

use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $movie_total = Movie::count();
        $genre_total = Genre::count();
        $movies = Movie::with('category', 'movie_genre')
            ->leftJoin('episode', 'movie.id', '=', 'episode.id_movie')
            ->select('movie.*', DB::raw('COUNT(episode.id) as episode_count'))
            ->groupBy('movie.id')
            ->orderBy('movie.id', 'desc')
            ->get();

        View::share([
            'movie_total' => $movie_total,
            'genre_total' => $genre_total,
            'movies' => $movies
        ]);
    }
}
