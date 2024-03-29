<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReviewedWorkbook extends Notification implements ShouldQueue
{
    use Queueable;

    public $workbook;
    // public $taskname;
    // public $boardname;
    // public $update;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($workbook)
    {
        //
        $this->workbook = $workbook;
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
                'text' => 'The workbook '.$this->workbook['name'].' has been reviewed by'.$this->workbook['brand']['name'],
                'action' => '/workbook/'.$this->workbook['id'],
                'color' => 'notif-icon bg-warning',
                'icon' => 'fa fa-star medium-avatar'
            ];
       
        
    }
    public function toBroadcast($notifiable)
    {
      return [
                'text' => 'The workbook '.$this->workbook['name'].' has been reviewed by'.$this->workbook['brand']['name'],
                'action' => '/workbook/'.$this->workbook['id'],
                'color' => 'notif-icon bg-warning',
                'icon' => 'fa fa-star medium-avatar'
            ];
       
        
    }
}
