<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Episode;

class AdminController extends Controller
{
    public function index()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $api = "https://phim.nguonc.com/api/films/phim-moi-cap-nhat?page=" . $page;
        $data = Http::get($api)->json();

        $movieUpdateToday = Movie::where('updated_at', 'like', '%' . date('Y-m-d') . '%')->count();
        $moviesIncomplete = Movie::select('movie.*', DB::raw('COUNT(episode.id) as episode_count'))
            ->leftJoin('episode', 'movie.id', '=', 'episode.id_movie')
            ->groupBy('movie.id')
            ->havingRaw('episode_count < movie.total_episodes')
            ->count();

        $movies = Movie::where('status', 1)->get();

        return view('admin.index', compact('data', 'movies', 'movieUpdateToday', 'moviesIncomplete'));
    }

    // Đồng bộ thêm phim và cả tập
    public function add_full_movie($page)
    {
        $api = "https://phim.nguonc.com/api/films/phim-moi-cap-nhat?page=" . $page;
        $data = Http::get($api)->json();

        $success = '';
        $warning = '';

        foreach ($data['items'] as $value) {
            $api_detail = "https://phim.nguonc.com/api/film/" . $value['slug'];
            $data_detail = Http::get($api_detail)->json();

            $movie_detail = $data_detail['movie'];

            // Kiểm tra xem phim đã tồn tại trong cơ sở dữ liệu hay chưa
            $existing_movie = Movie::where('slug', $movie_detail['slug'])->first();
            if ($existing_movie) {
                $warning = 'Phim ' . $movie_detail['name'] . ' đã tồn tại.';
                continue;
            }

            // Nếu phim chưa tồn tại, thực hiện thêm mới
            $movie = new Movie();
            $movie->name = $movie_detail["name"];
            $movie->slug = $movie_detail["slug"];
            $movie->original_name = $movie_detail["original_name"];
            $movie->description = $movie_detail["description"];
            $movie->status = 1;
            $movie->thumb_url = $movie_detail["thumb_url"];
            $movie->poster_url = $movie_detail["poster_url"];
            $movie->time = $movie_detail["time"];
            $movie->total_episodes = $movie_detail["total_episodes"];
            $movie->quality = 1;
            $movie->language = 1;
            $movie->director = $movie_detail["director"];
            $movie->casts = $movie_detail["casts"];

            $category = Category::first();
            $genre = Genre::first();
            $country = Country::first();

            $movie->id_category = $category->id_category;
            $movie->id_genre = $genre->id;
            $movie->id_country = $country->id;
            $movie->hot = 1;

            $movie->save();
            $movie->movie_genre()->attach($genre->id);

            // Thêm tập
            $largestEpisode = Episode::where('id_movie', $movie->id)
                ->orderBy('episode', 'desc')
                ->first();

            foreach ($movie_detail['episodes'] as $key => $episodes) {
                foreach ($episodes['items'] as $value) {
                    $newEpisodeNumber = (count($value) == 1) ? (($value['name'] == "FULL") ? 1 : $value['name']) : $value['name'];

                    if (!$largestEpisode || $largestEpisode->episode < $newEpisodeNumber) {
                        $episode = new Episode();
                        $episode->id_movie = $movie->id;
                        $episode->link_movie = $value['embed'];
                        $episode->episode = $newEpisodeNumber;
                        $episode->save();

                        $success = 'Thêm tập phim thành công';
                    } else {
                        $warning = 'Không có tập phim mới để thêm';
                    }
                }
            }
        }

        return back()->with('success', $success)->with('warning', $warning);
    }




    public function add_movie_api($slug)
    {
        $api = "https://phim.nguonc.com/api/film/" . $slug;
        $data_movie_detail = Http::get($api)->json();

        $existing_movie = Movie::where('slug', $data_movie_detail['movie']['slug'])->first();

        if (!$existing_movie) {
            $movie = new Movie();
            $movie->name = $data_movie_detail['movie']["name"];
            $movie->slug = $data_movie_detail['movie']["slug"];
            $movie->original_name = $data_movie_detail['movie']["original_name"];
            $movie->description = $data_movie_detail['movie']["description"];
            $movie->status = 1;
            $movie->thumb_url = $data_movie_detail['movie']["thumb_url"];
            $movie->poster_url = $data_movie_detail['movie']["poster_url"];
            $movie->time = $data_movie_detail['movie']["time"];
            $movie->total_episodes = $data_movie_detail['movie']["total_episodes"];

            $movie->quality = 1;
            $movie->language = 1;
            $movie->director = $data_movie_detail['movie']["director"];
            $movie->casts = $data_movie_detail['movie']["casts"];

            $category = Category::first();
            $genre = Genre::first();
            $country = Country::first();

            $movie->id_category = $category->id_category;
            $movie->id_genre = $genre->id;
            $movie->id_country = $country->id;
            $movie->hot = 1;

            // return response()->json($movie);

            $movie->save();
            $movie->movie_genre()->attach($genre->id);

            $success = "Thêm phim thành công";
            return back()->with('success', $success);
        } else {
            $warning = "Đã tồn tại phim";
            return back()->with('warning', $warning);
        }
    }


    public function add_movie_episode_api($slug)
    {
        $movie_find = Movie::where('slug', $slug)->first();

        $api = "https://phim.nguonc.com/api/film/" . $slug;
        $data_movie_detail = Http::get($api)->json();


        $largestEpisode = Episode::selectRaw('id_movie, COUNT(episode) AS episode_count')
            ->where('id_movie', $movie_find->id)
            ->groupBy('id_movie')
            ->get();

        $success = '';
        $warning = '';

        // dd($data_movie_detail['movie']['episodes']);

        $episode_count = "";
        foreach ($largestEpisode as $ep) {
            $episode_count = $ep->episode_count;
        }

        foreach ($data_movie_detail['movie']['episodes'] as $key => $episodes) {
            foreach ($episodes['items'] as $value) {
                $newEpisodeNumber = (count($value) == 1) ? (($value['name'] == "FULL") ? 1 : $value['name']) : $value['name'];

                if ($newEpisodeNumber > $episode_count) {
                    $episode = new Episode();
                    $episode->id_movie = $movie_find->id;
                    $episode->link_movie = $value['embed'];
                    $episode->episode = $newEpisodeNumber;
                    $episode->save();

                    $success = 'Thêm tập phim thành công';
                } else {
                    $warning = 'Không có tập phim mới để thêm';
                }
            }
        }

        return back()->with('success', $success)->with('warning', $warning);
    }


    // Đăng kí đăng nhập
    public function register()
    {
        return view('admin.login.register');
    }
    public function registerPost(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Bạn đăng kí thành công');
    }
    public function login()
    {
        return view('admin.login.login');
    }
    public function loginPost(Request $request)
    {
        $credetaials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($credetaials)) {
            return redirect('admin')->with('success', 'Bạn đăng nhập thành công');
        }
        return back()->with('error', 'Sai tài khoản và mật khẩu');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin-login');
    }

    public function user_manager()
    {
        $user = User::all();
        return view('admin.user.index', compact('user'));
    }
    public function user_edit($id)
    {
        $user = User::find($id);
        return view('admin.user.update', compact('user'));
    }
    public function user_put(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'role' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.regex' => 'Email không đúng định dạng',
            'role.required' => 'Vui lòng chọn quyền',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        return redirect('user-manager')->with('success', 'Cập nhật người dùng thành công');
    }

    public function user_delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('user-manager')->with('success', 'Xóa người dùng thành công');
    }
}
