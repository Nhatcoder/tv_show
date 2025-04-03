<?php

namespace App\Listeners;

use App\Events\Comment;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendComment implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Comment $event): void
    {
        $coment = $event->comment;
        // broadcast(new Comment($coment));

    }
}
