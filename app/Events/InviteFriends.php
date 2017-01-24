<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class InviteFriends extends Event
{
    use SerializesModels;

    public $currentUserId;

    public $inviteUserId;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($currentUserId, $inviteUserId, $message = "")
    {
        $this->currentUserId = $currentUserId;
        $this->inviteUserId = $inviteUserId;
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
