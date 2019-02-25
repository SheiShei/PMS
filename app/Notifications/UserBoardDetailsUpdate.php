<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserBoardDetailsUpdate extends Notification implements ShouldQueue
{
    use Queueable;

    public $board;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($board, $user)
    {
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
            'text' => 'Admin ' . $this->user . ' updated the settings of board: '.$this->board['name'],
            'action' => $this->board['type'] == 1 ? '/boards/kanban/'.$this->board['id'] : '/boards/scrum/'.$this->board['id'],
            'color' => 'notif-icon bg-success',
            'icon' => 'fa fa-trello medium-avatar'
        ];
    }
    public function toBroadcast($notifiable)
    {
        return [
            'text' => 'Admin ' . $this->user . ' updated the settings of board: '.$this->board['name'],
            'action' => $this->board['type'] == 1 ? '/boards/kanban/'.$this->board['id'] : '/boards/scrum/'.$this->board['id'],
            'color' => 'notif-icon bg-success',
            'icon' => 'fa fa-trello medium-avatar'
        ];
    }
}
