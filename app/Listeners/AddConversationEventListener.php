<?php

namespace App\Listeners;

use App\Events\AddConversationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddConversationEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AddConversationEvent  $event
     * @return void
     */
    public function handle(AddConversationEvent $event)
    {
        //
    }
}
