<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_genre;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{

    public function index()
    {
        $category = Category::all();
        $movies = Movie::with('category', 'movie_genre')->withCount('episode')->orderBy('id', 'desc')->get();

        $path = public_path() . "/json/";
        if (!is_dir($path)) { // not a directory or không có file thì tạo mới
            mkdir($path, 0777, true);
        }

        File::put($path . 'movies.json', json_encode($movies));

        return view('admin.movie.index', compact('movies', 'category'));
    }

    // update status
    public function update_movie_status(Request $request)
    {
        $movie = Movie::find($request->id);
        $movie->status = $request->status;
        $movie->save();
    }

    // update category
    public function update_movie_category(Request $request)
    {
        $movie = Movie::find($request->id);
        $movie->id_category = $request->id_category;
        $movie->save();
    }
    // update quality
    public function update_movie_quality(Request $request)
    {
        $movie = Movie::find($request->id);
        $movie->quality = $request->quality;
        $movie->save();
    }
    // update language
    public function update_movie_language(Request $request)
    {
        $movie = Movie::find($request->id);
        $movie->language = $request->language;
        $movie->save();
    }

    // update slider hot
    public function update_movie_hot_slider(Request $request)
    {
        $movie = Movie::find($request->id);
        $movie->hot_slider = $request->hot_slider;
        $movie->save();
    }

    public function create()
    {
        $category = Category::all();
        $genre = Genre::all();
        return view('admin.movie.add', compact('category', 'genre'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:movie|max:255',
            'slug' => 'required|unique:movie|max:255',
            'original_name' => 'required|unique:movie|max:255',
            'time' => 'required|max:255',
            'total_episodes' => 'required|numeric|min:1|max:2000',
            'description' => 'required',
            'genre' => 'required|array',
            'director' => 'required',
            'casts' => 'required',
            'poster_url' => 'required|active_url',
            'thumb_url' => 'required|active_url',
            'id_category' => 'required',
            'quality' => 'required',
            'language' => 'required',
            'hot' => 'required',
            'hot_slider' => 'nullable',
        ], [
            'name.required' => 'Vui lòng nhập tên!',
            'name.max' => 'Tên không được vượt quá 255 ký tự!',
            'name.unique' => 'Tên phim đã tồn tại!',

            'total_episodes.required' => 'Vui lòng nhập tập phim!',
            'total_episodes.numeric' => 'Nhập phải là số!',
            'total_episodes.min' => 'Nhập tối thiểu phải là số 1!',
            'total_episodes.max' => 'Số tập không lớn hơn 2000!',

            'slug.required' => 'Vui lòng nhập slug!',
            'slug.max' => 'Slug không được vượt quá 255 ký tự!',
            'slug.unique' => 'Slug phim đã tồn tại!',
            'genre.required' => 'Vui lòng chọn thể loại phim!',
            'genre.array' => 'Thể loại phim phải là một mảng!',
            'original_name.required' => 'Vui lòng nhập tên tiếng anh!',
            'original_name.max' => 'Tên anh không được vượt quá 255 ký tự!',
            'original_name.unique' => 'Tên anh phim đã tồn tại!',
            'time.required' => 'Vui lòng nhập thời lượng phim!',
            'time.max' => 'Thời lượng không được vượt quá 255 ký tự!',
            'description.required' => 'Vui lòng nhập mô tả!',
            'director.required' => 'Vui lòng nhập tên đạo diễn!',
            'casts.required' => 'Vui lòng nhập diễn viên!',

            'poster_url.required' => 'Vui lòng nhập ảnh!',
            'poster_url.active_url' => 'Phải là địa chỉ ảnh!',
            'thumb_url.required' => 'Vui lòng nhập ảnh!',
            'thumb_url.active_url' => 'Phải là địa chỉ ảnh!',

        ]);

        $movie = new Movie();
        $movie->name = $data['name'];
        $movie->slug = $data['slug'];
        $movie->original_name = $data['original_name'];
        $movie->time = $data['time'];
        $movie->hot = $data['hot'];
        $movie->hot_slider = $data['hot_slider'];
        $movie->total_episodes = $data['total_episodes'];
        $movie->description = $data['description'];
        $movie->director = $data['director'];
        $movie->casts = $data['casts'];
        $movie->quality = $data['quality'];
        $movie->language = $data['language'];
        $movie->thumb_url = $data['thumb_url'];
        $movie->poster_url = $data['poster_url'];
        $movie->id_category = $data['id_category'];

        foreach ($data['genre'] as $key => $value) {
            $movie->id_genre = $value[0];
        }

        $movie->save();

        $movie->movie_genre()->attach($data['genre']);

        return redirect('movie')->with('success', 'Bạn thêm thành công !');
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
    public function edit(string $id)
    {
        $movie = Movie::find($id);
        $category = Category::all();
        $genre = Genre::all();
        $movie_genre = Movie_genre::where('id_movie', $id)->get();

        return view('admin.movie.update', compact('movie', 'category', 'genre', 'movie_genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'original_name' => 'required|max:255',
            'total_episodes' => 'required|numeric|min:1|max:2000',
            'time' => 'nullable|max:255',
            'description' => 'required',
            'genre' => 'required|array',
            'director' => 'nullable',
            'casts' => 'nullable',
            'poster_url' => 'required',
            'thumb_url' => 'required',
            'id_category' => 'required',
            'quality' => 'required',
            'language' => 'required',
            'hot' => 'required',
            'hot_slider' => 'nullable',
        ], [
            'name.required' => 'Vui lòng nhập tên!',
            'name.max' => 'Tên không được vượt quá 255 ký tự!',
            'slug.required' => 'Vui lòng nhập slug!',
            'slug.max' => 'Slug không được vượt quá 255 ký tự!',
            'total_episodes.required' => 'Vui lòng nhập tập phim!',
            'total_episodes.numeric' => 'Nhập phải là số!',
            'total_episodes.min' => 'Nhập tối thiểu phải là số 1!',
            'total_episodes.max' => 'Số tập không lớn hơn 2000!',
            'genre.required' => 'Vui lòng chọn thể loại phim!',
            'genre.array' => 'Thể loại phim phải là một mảng!',
            'original_name.required' => 'Vui lòng nhập tên tiếng anh!',
            'original_name.max' => 'Tên anh không được vượt quá 255 ký tự!',
            // 'time.required' => 'Vui lòng nhập thời lượng phim!',
            'time.max' => 'Thời lượng không được vượt quá 255 ký tự!',
            'description.required' => 'Vui lòng nhập mô tả!',
            'director.required' => 'Vui lòng nhập tên đạo diễn!',
            'casts.required' => 'Vui lòng nhập diễn viên!',
            'poster_url.required' => 'Vui lòng nhập ảnh!',
            'thumb_url.required' => 'Vui lòng nhập ảnh!',
            'id_category.required' => '',
        ]);

        $movie = Movie::find($id);
        $movie->name = $data['name'];
        $movie->slug = $data['slug'];
        $movie->original_name = $data['original_name'];
        $movie->time = $data['time'];
        $movie->hot = $data['hot'];
        $movie->hot_slider = $data['hot_slider'];
        $movie->total_episodes = $data['total_episodes'];
        $movie->description = $data['description'];
        $movie->director = $data['director'];
        $movie->casts = $data['casts'];
        $movie->quality = $data['quality'];
        $movie->language = $data['language'];
        $movie->thumb_url = $data['thumb_url'];
        $movie->poster_url = $data['poster_url'];
        $movie->id_category = $data['id_category'];

        foreach ($data['genre'] as $key => $value) {
            $movie->id_genre = $value[0];
        }

        $movie->save();
        $movie->movie_genre()->sync($data['genre']);

        return redirect('movie')->with('success', 'Bạn đã cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::find($id);
        if ($movie) {
            $movie->delete();

            Movie_Genre::whereIn('id_movie', [$movie->id])->delete();
            Episode::whereIn('id_movie', [$movie->id])->delete();

            // return redirect('movie')->with('success', "Bạn xóa thành công");
            return back()->with('success', "Bạn xóa thành công");
        }
    }
}
