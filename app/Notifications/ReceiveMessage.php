<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReceiveMessage extends Notification implements ShouldQueue
{
    use Queueable;

    public $cuser;
    public $receivers;
    public $message;
    

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($cuser, $message, $receivers)
    {
        $this->cuser = $cuser;
        $this->receivers = $receivers;
        $this->message = $message;

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
        // $name = (string)$this->board['created_by']['name']; /boards/kanban/'.$this->board['id']
        return [
            'text' => 'You have new message received!',
            'action' => '/messages/'.$this->receivers,
            'color' => 'notif-icon bg-info',
            'icon' => 'fa fa-envelope-o medium-avatar'
        ];
    }
    public function toBroadcast($notifiable)
    {
        // $name = (string)$this->board['created_by']['name']; /boards/kanban/'.$this->board['id']
        return [
            'text' => 'You have new message received!',
            'action' => '/messages/'.$this->receivers,
            'message' => $this->message,
            'sender' => $this->receivers,
            'color' => 'notif-icon bg-info',
            'icon' => 'fa fa-envelope-o medium-avatar'
        ];
    }
}
