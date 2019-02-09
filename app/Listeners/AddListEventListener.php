<?php

namespace App\Listeners;

use App\Events\AddListEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddListEventListener
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
     * @param  AddListEvent  $event
     * @return void
     */
    public function handle(AddListEvent $event)
    {
        //
    }
}
