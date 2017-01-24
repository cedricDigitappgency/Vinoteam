<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostCreateRelationship extends Event
{
    use SerializesModels;

    public $user1Id;

    public $user2id;

    public $message = "";

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user1Id, $user2Id, $message="")
    {
        $this->user1Id = $user1Id;
        $this->user2Id = $user2Id;
        $this->message = $message;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
