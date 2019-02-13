<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class BoardCreated extends Notification implements ShouldQueue
{
    use Queueable;

    public $board;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($board)
    {
        $this->board = json_decode($board, true);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
        // $name = (string)$this->board['created_by']['name']; /boards/kanban/'.$this->board['id']
        return [
            'text' => $this->board['created_by']['name'] . ' created the board: '.$this->board['name'],
            'action' => $this->board['type'] == 1 ? '/boards/kanban/'.$this->board['id'] : '/boards/scrum/'.$this->board['id'],
            'color' => 'bg-success',
            'icon' => 'fa-trello'
        ];
    }
}
