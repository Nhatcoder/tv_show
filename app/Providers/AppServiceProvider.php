<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_genre;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        try {
            $movie_total = Movie::count();
            $genre_total = Genre::count();
            $movies = Movie::with('category', 'movie_genre')
                ->leftJoin('episode', 'movie.id', '=', 'episode.id_movie')
                ->select('movie.*', DB::raw('COUNT(episode.id) as episode_count'))
                ->groupBy('movie.id')
                ->orderBy('movie.id', 'desc')
                ->get();
        } catch (\Exception $e) {
            // Log the error or handle it as necessary
            Log::info('Error fetching movie data: ' . $e->getFile() . " - " . $e->getLine() . " - " . $e->getMessage());
            $movie_total = 0;
            $genre_total = 0;
            $movies = collect();
        }

        View::share([
            'movie_total' => $movie_total,
            'genre_total' => $genre_total,
            'movies' => $movies
        ]);
    }
}
