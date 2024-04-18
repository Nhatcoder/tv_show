<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::orderby('id', 'desc')->get();
        return view('admin.genre.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.genre.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        $data = $request->validate(
            [
                'name' => 'required|unique:genre|max:255',
                'slug' => 'required|unique:genre|max:255',
                'status' => ['nullable'] //được coi là null kh check
            ],
            [
                'name.unique' => 'Tên thể loại này đã bị trùng, Xin vui lòng điền tên khác',
                'slug.unique' => 'Slug thể loại này đã bị trùng, Xin vui lòng điền slug khác',
                'name.required' => 'Vui lòng nhập tên !',
                'slug.required' => 'Vui lòng nhập slug !'
            ]
        );

        $genre = new Genre();
        $genre->name = $data['name'];
        $genre->slug = $data['slug'];

        $genre->save();
        return redirect('genre')->with('success', 'Bạn thêm thành công !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genre = Genre::where('id', $id)->first();
        return view('admin.genre.update', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $data = $request->all();
        $data = $request->validate(
            [
                'name' => 'required|max:255',
                'slug' => 'required|max:255',
                'status' => ['nullable'] //được coi là null kh check
            ],
            [
                'name.required' => 'Vui lòng nhập tên !',
                'slug.required' => 'Vui lòng nhập slug !'
            ]
        );

        $genre = Genre::find($id);
        $genre->name = $data['name'];
        $genre->slug = $data['slug'];
        $genre->status = $data['status'];

        $genre->save();
        return redirect('genre')->with('success', 'Bạn cập nhật thành công !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genre = Genre::find($id);
        if ($genre) {
            $genre->delete();
            return redirect('genre')->with('success', 'Bạn cập nhật thành công !');
        } else {
            return redirect('genre')->with('success', 'Không xóa được lỗi !');
        }
    }
}
