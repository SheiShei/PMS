<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class SendTextMessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $newMessage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($newMessage)
    {
        $this->newMessage = $newMessage;
        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('convo.'.json_decode($this->newMessage, true)['id']);

        if(json_decode($this->newMessage, true)['conversation_id']){
            return new PrivateChannel('convo.'.json_decode($this->newMessage, true)['conversation_id']);
        }
        return new PrivateChannel('convo.'.json_decode($this->newMessage, true)['sender']['slug']);
    }
}
