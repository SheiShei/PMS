<?php

namespace App\Listeners;

use App\Events\AddMemberEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddMemberEventListener
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
     * @param  AddMemberEvent  $event
     * @return void
     */
    public function handle(AddMemberEvent $event)
    {
        //
    }
}
