<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BoardUpdateListSprint extends Notification implements ShouldQueue
{
    use Queueable;
    public $cuser;
    public $oldList;
    public $newList;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($cuser, $oldList, $newList, $type)
    {
        $this->cuser = $cuser;
        $this->oldList = $oldList;
        $this->newList = $newList;
        $this->type = $type;
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
            'text' => $this->cuser.' renamed the '. $this->type . ' ' .$this->oldList.' to: '.$this->newList,
            'action' => '',
            'color' => 'bg-info',
            'icon' => 'fa-trello'
        ];
    }
}
