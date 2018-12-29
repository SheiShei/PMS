<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('message.{id}', function ($user, $mid) {
    return true;
});

Broadcast::channel('addconvo', function($user){
    return true;
});

Broadcast::channel('list.{id}', function ($user, $lid) {
    return true;
});

Broadcast::channel('task.{id}', function ($user, $tid) {
    return true;
});
