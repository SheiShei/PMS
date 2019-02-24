<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DirectMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $conversation;
    public $receiver;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $receiver, $conversation)
    {   
        $this->message = $message;
        $this->receiver = $receiver;
        $this->conversation = $conversation;
        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        if($this->conversation){
            return new PrivateChannel('message.'.$this->conversation->id);
        }
        return new PrivateChannel('message.'.$this->receiver->slug);
    }
}
