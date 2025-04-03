<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class Comment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $comment;
    public $movie_id;
    public function __construct($comment, $movie_id)
    {
        $this->comment = $comment;
        $this->movie_id = $movie_id;
    }


    public function broadcastOn()
    {
        // Log::debug('ID Phim này là: ' . $this->movie_id);
        return new channel('comment.' . $this->movie_id);
    }
}
