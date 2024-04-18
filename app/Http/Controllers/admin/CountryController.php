<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all();
        return view('admin.country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.country.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|unique:country|max:255',
                'slug' => 'required|unique:country|max:255',
                'status' => ['nullable']
            ],
            [
                'name.unique' => 'Tên thể loại này đã bị trùng, Xin vui lòng điền tên khác',
                'slug.unique' => 'Slug thể loại này đã bị trùng, Xin vui lòng điền slug khác',
                'name.required' => 'Vui lòng nhập tên !',
                'slug.required' => 'Vui lòng nhập slug !'
            ]
        );

        $country = new Country();
        $country->name = $data['name'];
        $country->slug = $data['slug'];

        $country->save();
        return redirect('country')->with('success', 'Bạn thêm thành công !');
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
        $country = Country::where('id', $id)->first();
        return view('admin.country.update', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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

        $genre = Country::find($id);
        $genre->name = $data['name'];
        $genre->slug = $data['slug'];
        $genre->status = $data['status'];

        $genre->save();
        return redirect('country')->with('success', 'Bạn cập nhật thành công !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = Country::where('id', $id)->first();
        if ($country) {
            $country->delete();
            return redirect('country')->with('success', 'Bạn xóa thành công !');
        }
    }
}
