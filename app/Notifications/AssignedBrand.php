<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AssignedBrand extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $brand;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $brand)
    {
        //
        $this->user = $user;
        $this->brand = $brand;
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
            'text' => $this->user.' assigned you to brand: '.$this->brand['name'],
            'action' => '/brands/brand-profile-'.$this->brand['id'],
            'color' => 'notif-icon bg-info',
            'icon' => 'fa fa-suitcase medium-avatar'
        ];
    }
}
