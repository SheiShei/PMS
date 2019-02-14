<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BoardAssignTask extends Notification implements ShouldQueue
{
    use Queueable;

    public $cuser;
    public $task;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($cuser, $task, $user)
    {
        $this->cuser = $cuser;
        $this->task = $task;
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
            'text' => $this->cuser . ' assigned task: '.$this->task.' to '.$this->user,
            'action' => '',
            'color' => 'bg-info',
            'icon' => 'fa-tasks'
        ];
    }
}
