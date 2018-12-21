<?php

namespace App\Listeners;

use App\Events\DirectMessageEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DirectMessageEventListener
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
     * @param  DirectMessageEvent  $event
     * @return void
     */
    public function handle(DirectMessageEvent $event)
    {
        //
    }
}
