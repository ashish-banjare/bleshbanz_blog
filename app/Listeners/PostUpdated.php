<?php

namespace App\Listeners;

use App\Events\PostUpdated as EventPostUpdated;

class PostUpdated
{
    /**
     * Handle the event.
     *
     * @param  PostUpdated  $event
     * @return void
     */
    public function handle(EventPostUpdated $event)
    {
        //
    }
}
