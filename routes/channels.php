<?php

use App\Models\Movie;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('comment.{movie_id}', function ($user, $movie_id) {
    $movie = Movie::find($movie_id);

    // Nếu không tìm thấy movie hoặc user không có quyền truy cập vào movie đó, trả về false
    if (!$movie || !$user) {
        return false;
    }
});



