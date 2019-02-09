<?php

namespace App\Listeners;

use App\Events\DeleteListEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteListEventListener
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
     * @param  DeleteListEvent  $event
     * @return void
     */
    public function handle(DeleteListEvent $event)
    {
        //
    }
}
