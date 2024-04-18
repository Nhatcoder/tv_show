<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Models\Movie;
use App\Models\Category;
use App\Models\Episode;
use App\Models\Genre;

class IndexController extends Controller
{
    public function movie_search(Request $request, $slug)
    {
        $category = Category::orderBy('id_category', 'DESC')->get();
        $movie_search_link = Movie::where('slug', $slug)->where('status', 1)->first();

        return view('user.pages.search_link', compact('category', 'movie_search_link'));
    }
    public function movie_search_post(Request $request)
    {
        $category = Category::orderBy('id_category', 'DESC')->get();

        $search = $request->input('search');
        // $movie = Movie::where('tittle', 'LIKE', '%' . $search . '%')->orderBy('ngaycapnhat', 'DESC')->paginate(12);
        $movie_search = Movie::where('name', 'LIKE', '%' . $search . '%')->orderBy('id', 'DESC')->get();
        
        // return response()->json($movie_search);

        return view('user.pages.search', compact('category', 'movie_search'));
    }
    public function index()
    {
        $hot_movie = Movie::where('hot', 1)->where('status', 1)->orderBy('id', 'desc')->take(12)->get();
        $series_movie = Movie::where('id_category', 73)->where('status', 1)->orderBy('id', 'desc')->take(12)->get();
        $cartoon = Movie::where('id_category', 74)->where('status', 1)->orderBy('id', 'desc')->take(12)->get();
        $single_movie = Movie::where('id_category', 75)->where('status', 1)->orderBy('id', 'desc')->take(12)->get();
        $theater_screening = Movie::where('id_category', 76)->where('status', 1)->orderBy('id', 'desc')->take(12)->get();
        $category = Category::orderBy('id_category', 'DESC')->get();
        $movie_slider = Movie::with('movie_genre')->where('hot_slider', 1)->orderBy('id', 'desc')->take(5)->get();

        // $movie_episode_first = Episode::where('id_movie', $movie_slider->id)->first();
        

        return view('user.index', compact('hot_movie', 'series_movie', 'cartoon', 'single_movie', 'theater_screening', 'category', 'movie_slider'));
    }

    public function profile()
    {
        $category = Category::orderBy('id_category', 'DESC')->get();

        // return response()->json(Auth::user());

        return view('user.pages.profile', compact('category'));
    }

    public function category($slug)
    {

        $category = Category::orderBy('id_category', 'DESC')->get();
        $category_slug = Category::where('slug', $slug)->first();
        $category_movie = Movie::where('id_category', $category_slug->id_category)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->paginate(18);

        // return response()->json(count($categpry_movie));

        return view('user.pages.category', compact('category', 'category_slug', 'category_movie'));
    }
    public function movie_detail($slug)
    {
        $category = Category::orderBy('id_category', 'DESC')->get();
        $movie_detail = Movie::with('movie_genre', 'episode')->where('slug', $slug)->where('status', 1)->first();

        $movie_related = Movie::where('id_category', $movie_detail->id_category)->where('id', '!=', $movie_detail->id)->where('status', 1)->inRandomOrder()->take(12)->get();

        // Lấy tập đầu
        $movie_episode_first = Episode::where('id_movie', $movie_detail->id)->first();

        return view('user.pages.detail', compact('category', 'movie_detail', 'movie_related', 'movie_episode_first'));
    }

    public function watch($slug, $episode)
    {
        $category = Category::orderBy('id_category', 'DESC')->get();

        $movie = Movie::with('movie_genre', 'episode')->where('slug', $slug)->where('status', 1)->first();

        $episode = Episode::where('id_movie', $movie->id)->where('episode', $episode)->first();

        $movie_related = Movie::where('id_category', $movie->id_category)->where('id', '!=', $movie->id)->where('status', 1)->inRandomOrder()->take(12)->get();

        // return response()->json($movie->episode);

        return view('user.pages.watch', compact('category', 'movie', 'episode', 'movie_related'));
    }
}
