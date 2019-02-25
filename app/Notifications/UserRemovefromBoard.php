<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRemovefromBoard extends Notification implements ShouldQueue
{
    use Queueable;

    public $cuser;
    public $board;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($cuser, $board, $user)
    {
        $this->cuser = $cuser;
        $this->board = $board;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'text' => $this->cuser.' removed you from the board: '.$this->board['name'],
            'action' => '',
            'color' => 'notif-icon bg-danger',
            'icon' => 'fa fa-trello medium-avatar'
        ];
    }
    
    public function toBroadcast($notifiable)
    {
        return [
            'text' => $this->cuser.' removed you from the board: '.$this->board['name'],
            'action' => '',
            'color' => 'notif-icon bg-danger',
            'icon' => 'fa fa-trello medium-avatar'
        ];
    }
}
