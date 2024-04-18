<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::OrderBy('id_category', 'DESC')->get();
        return view('admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $category = new Category();
        $category->name = $data['name'];
        $category->slug = $data['slug'];



        // $category->save();
        return redirect('category')->with('success', 'Bạn thêm thành công !');
        // return back()->with('success', 'Bạn thêm thành công !');
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
        $category = Category::where('id_category', $id)->first();
        return view('admin.category.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $category = Category::where('id_category', $id)->first();
        $category->name = $data['name'];
        $category->slug = $data['slug'];
        $category->status = $data['status'];

        $category->save();
        return redirect('category')->with('success', 'Bạn cập nhật thành công !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::where('id_category', $id)->first();

        if ($category) {
            $category->delete();
            $success = 'Bạn xóa thành công!';
        } else {
            $success = 'Bạn xóa không thành công!';
        }

        return redirect('category')->with('success', $success);
    }
}
