<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserNewWorkbook extends Notification implements ShouldQueue
{
    use Queueable;

    public $cuser;
    public $workbook;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($cuser, $workbook, $type)
    {
        $this->cuser = $cuser;
        $this->workbook = $workbook;
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
            'text' => $this->cuser . ' has submitted the workbook: '.$this->workbook['name'],
            'action' => $this->type == 'admin' ? '/workbook/'.$this->workbook['id'] : '/workbook/'.$this->workbook['id'].'/review',
            'color' => 'notif-icon bg-warning',
            'icon' => 'fa fa-star medium-avatar'
        ];
    }
    public function toBroadcast($notifiable)
    {
        return [
            'text' => $this->cuser . ' has submitted the workbook: '.$this->workbook['name'],
            'action' => $this->type == 'admin' ? '/workbook/'.$this->workbook['id'] : '/workbook/'.$this->workbook['id'].'/review',
            'color' => 'notif-icon bg-warning',
            'icon' => 'fa fa-star medium-avatar'
        ];
    }
}
