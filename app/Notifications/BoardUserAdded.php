<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BoardUserAdded extends Notification implements ShouldQueue
{
    use Queueable;

    public $board, $user;

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
        if($this->board['type'] == 1) {
            return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', config('services.passport.login_endpoint').'boards/kanban/'.$this->board['id'])
                    ->line('Thank you for using our application!');
        }
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', config('services.passport.login_endpoint').'boards/scrum/'.$this->board['id'])
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
        $name = (string)$this->board['created_by']['name'];
        // var_dump($name);
        // $name = 'shei';
        return [
            'text' => $this->user.' added you to '.$this->board['name'],
            'action' => $this->board['type'] == 1 ? '/boards/kanban/'.$this->board['id'] : '/boards/scrum/'.$this->board['id'],
            'color' => 'notif-icon bg-success',
            'icon' => 'fa fa-trello medium-avatar'
        ];
    }
    public function toBroadcast($notifiable)
    {
        $name = (string)$this->board['created_by']['name'];
        // var_dump($name);
        // $name = 'shei';
        return [
            'text' => $this->user.' added you to '.$this->board['name'],
            'action' => $this->board['type'] == 1 ? '/boards/kanban/'.$this->board['id'] : '/boards/scrum/'.$this->board['id'],
            'color' => 'notif-icon bg-success',
            'icon' => 'fa fa-trello medium-avatar'
        ];
    }
}
