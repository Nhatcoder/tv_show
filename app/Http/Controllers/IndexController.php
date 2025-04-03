<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Genre;

use App\Models\Movie;
use App\Models\Comment;
use App\Models\Episode;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\View;
use App\Events\Comment as EventsComment;
use App\Events\TestEvent;

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

        $movie_episode_first = Episode::where('id_movie', $movie_detail->id)->first();

        return view('user.pages.detail', compact('category', 'movie_detail', 'movie_related', 'movie_episode_first'));
    }

    public function watch($slug, $episode)
    {
        $category = Category::orderBy('id_category', 'DESC')->get();
        $movie = Movie::with('movie_genre', 'episode')->where('slug', $slug)->where('status', 1)->first();
        $episode = Episode::where('id_movie', $movie->id)->where('episode', $episode)->first();
        $movie_related = Movie::where('id_category', $movie->id_category)->where('id', '!=', $movie->id)->where('status', 1)->inRandomOrder()->take(12)->get();

        $userNow = "";
        if (Auth::check()) {
            $userNow = User::where('id', Auth::user()->id)->first();
        }
        $listComent = Comment::where('movie_id', $movie->id)
            ->with('user')->get();

        // return response()->json($listComent);
        // return response()->json($listComent);

        return view('user.pages.watch', compact('category', 'movie', 'episode', 'movie_related', 'userNow', 'listComent'));


    }

    public function movieComment(Request $request)
    {
        if (!empty($request->comment)) {
            $comment = new Comment();
            $comment->user_id = Auth::user()->id;
            $comment->movie_id = $request->movie_id;
            $comment->comment = $request->comment;
            $comment->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $comment->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $comment->save();

            $commentNew = Comment::where('id', $comment->id)
                ->with('user')->first();

            $view = View::make('user.pages.comment', compact('commentNew'))->render();
            // event(new EventsComment($view));
            // EventsComment::dispatch($view);

            $movie_id = (int) $request->movie_id;

            broadcast(new EventsComment($view, $movie_id));

        }
    }

    public function movieCommentLike(Request $request)
    {
        if (!empty($request->comment_id)) {
            $comment = Comment::find($request->comment_id);

            $comment->count_like = $comment->count_like + 1;
            $comment->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $comment->save();

            return response()->json($comment);
        }
    }



}
