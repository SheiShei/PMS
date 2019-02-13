<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BoardCreateTask extends Notification implements ShouldQueue
{
    use Queueable;

    public $task;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task = json_decode($task, true);
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
        if(array_key_exists('card', $this->task)) {
            return [
                'text' => $this->task['created_by']['name'] . ' created new task '.$this->task['name']. ' in '.$this->task['card']['name'],
                'action' => '',
                'color' => 'bg-success',
                'icon' => 'fa-tasks'
            ];
        }
        return [
            'text' => $this->task['created_by']['name'] . ' created new task '.$this->task['name']. ' in '.$this->task['us']['name'],
            'action' => '',
            'color' => 'bg-success',
            'icon' => 'fa-tasks'
        ];
    }
}
