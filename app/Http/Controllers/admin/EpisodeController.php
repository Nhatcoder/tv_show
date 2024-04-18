<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use Illuminate\Auth\Events\Validated;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_episodes = Episode::with('movie')->orderBy('id', 'desc')->get();
        return view("admin.episode.index", compact('list_episodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Movie::orderBy('id', 'desc')->get();

        $id_movie = 0;
        if (isset($_GET['id'])) {
            $id_movie = $_GET['id'];
        }

        return view("admin.episode.add", compact('list', 'id_movie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate(

            [
                'id_movie' => 'required',
                'link_movie' => 'required',
                'episode' => 'required|unique:episode,episode,NULL,id,id_movie,' . request()->id_movie,
            ],
            [
                'id_movie.required' => 'Bạn chưa chọn phim !',
                'link_movie.required' => 'Bạn chưa nhập link phim !',
                'episode.required' => 'Bạn chọn tập phim !',
                'episode.unique' => 'Tập phim đã tồn tại !',
            ],

        );

        $episode = new Episode();
        $episode->id_movie = $data['id_movie'];
        $episode->link_movie = $data['link_movie'];
        $episode->episode = $data['episode'];

        $episode->save();

        return redirect('episode')->with('success', "Bạn thêm tập phim thành công");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id_movie, $id_episode)
    {
        $episode = Episode::with('movie')->find($id_episode);
        $id_movie = intval($id_movie);


        return view("admin.episode.update", compact('episode', 'id_movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'id_movie' => 'required',
                'link_movie' => 'required',
                'episode' => 'required',
            ],
            [
                'id_movie.required' => 'Bạn chưa chọn phim !',
                'link_movie.required' => 'Bạn chưa nhập link phim !',
                'episode.required' => 'Bạn chọn tập phim !',
            ],

        );

        $episode = Episode::find($id);
        $episode->id_movie = $data['id_movie'];
        $episode->link_movie = $data['link_movie'];
        $episode->episode = $data['episode'];

        $episode->save();
        return back()->with('success', "Bạn cập nhật tập phim thành công");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $episode = Episode::find($id);
        // return response()->json($episode);
        $episode->delete();
        return back()->with('success', "Đã xóa tập phim thành công");
    }


    public function selectMovie(Request $request)
    {
        $movie = Movie::where('id', $request->id)->first();

        $ouput = '<option selected disabled value="">--- Chọn tập ---</option>';
        for ($i = 1; $i <= $movie->total_episodes; $i++) {
            $ouput .= '<option value="' . $i . '">' . $movie->name . ' - Tập ' . $i . '</option>';
        }
        echo $ouput;
    }
}
