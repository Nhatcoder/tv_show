<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\GenreController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\MovieController;
use App\Http\Controllers\admin\EpisodeController;
use App\Http\Controllers\admin\GetMovieApiController;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\LoginGoogleController;

use Illuminate\Support\Facades\Session;



// Admin
Route::group(['middleware' => 'guest'], function () {
    Route::get('/admin-login', [AdminController::class, 'login'])->name('admin-login');
    Route::post('/admin-login', [AdminController::class, 'loginPost'])->name('admin-login');
    // Route::get('/admin-register', [AdminController::class, 'register'])->name('admin-register');
    // Route::post('/admin-register', [AdminController::class, 'registerPost'])->name('admin-register');
});

Route::group(['middleware' => ['auth', 'user.role']], function () {
    // route phim api nguon cc
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin', 'index')->name('admin');
        Route::get('/add-full/{page}', 'add_full_movie')->name('add-full');
        Route::post('/add-movie/{slug}', 'add_movie_api')->name('add-movie');
        Route::post('/add-movie-episode/{slug}', 'add_movie_episode_api')->name('add-movie-episode');
        Route::get('/user-manager', 'user_manager')->name('user-manager');
        Route::get('/user-edit/{id}', 'user_edit')->name('user-edit');
        Route::put('/user-put/{id}', 'user_put')->name('user-put');
        Route::delete('/user-delete/{id}', 'user_delete')->name('user-delete');
    });

    Route::delete('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::resource('/category', CategoryController::class);
    Route::resource('/genre', GenreController::class);
    Route::resource('/country', CountryController::class);

    Route::resource('/movie', MovieController::class);
    Route::get('/movie-change-status', [MovieController::class, 'update_movie_status'])->name('movie-change-status');
    Route::get('/movie-change-quality', [MovieController::class, 'update_movie_quality'])->name('movie-change-quality');
    Route::get('/movie-change-language', [MovieController::class, 'update_movie_language'])->name('movie-change-language');
    Route::get('/movie-change-hot-slider', [MovieController::class, 'update_movie_hot_slider'])->name('movie-change-hot-slider');
    Route::get('/movie-change-category', [MovieController::class, 'update_movie_category'])->name('movie-change-category');
    Route::post('/movie-search', [MovieController::class, 'movieSearch'])->name('movieSearch');
    Route::post('/movie-delete', [MovieController::class, 'movieDelete'])->name('movieDelete');

    Route::resource('/episode', EpisodeController::class);
    Route::get('/episode/{id_movie}/{id_episode}/edit', [EpisodeController::class, 'edit'])->name('episode.edit');

    Route::get('/select-movie', [EpisodeController::class, 'selectMovie'])->name('select-movie');


    Route::get('/only-role', function () {
        echo "only role";
    });

});



// hủy session
// Route::get('/', [IndexController::class, function () {
//     return Session::flush();
// }])->name('/');


// user
Route::get('/', [IndexController::class, 'index'])->name('/');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginPost'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'registerPost'])->name('register');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/profile', [IndexController::class, 'profile'])->name('profile');

Route::get('/the-loai/{slug}', [IndexController::class, 'category'])->name('category');
Route::get('/phim/{slug}', [IndexController::class, 'movie_detail'])->name('detail');
Route::get('/xem-phim/{slug}/{episode}', [IndexController::class, 'watch'])->name('watch');

Route::get('/tim-kiem-link/{slug}', [IndexController::class, 'movie_search'])->name('tim-kiem/');
Route::get('/tim-kiem', [IndexController::class, 'movie_search_post'])->name('search');

// login by goole account
Route::controller(LoginGoogleController::class)->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name('login-by-google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});
