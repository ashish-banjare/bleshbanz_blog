<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;

class PostUpdated
{
    use SerializesModels;

    public $model;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Model $event)
    {
        $this->model = $model;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
