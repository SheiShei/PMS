<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\AddMemberEvent' => [
            'App\Listeners\AddMemberEventListener',
        ],
        'App\Events\AddConversationEvent' => [
            'App\Listeners\AddConversationEventListener',
        ],
        'App\Events\DirectMessageEvent' => [
            'App\Listeners\DirectMessageEventListener',
        ],
        'App\Events\AddListEvent' => [
            'App\Listeners\AddListEventListener',
        ],
        'App\Events\DeleteListEvent' => [
            'App\Listeners\DeleteListEventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
