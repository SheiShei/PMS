<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JOCreativeCreated extends Notification implements ShouldQueue
{
    use Queueable;

    public $newjo;
    public $auth;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($newjo, $auth)
    {
        //
        $this->newjo = $newjo;
        $this->auth = $auth;
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
        // if($this->board['type'] == 1) {
        //     return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', config('services.passport.login_endpoint').'boards/kanban/'.$this->board['id'])
        //             ->line('Thank you for using our application!');
        // }
        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', config('services.passport.login_endpoint').'boards/scrum/'.$this->board['id'])
        //             ->line('Thank you for using our application!');
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
            'text' => $this->auth . ' has created new Job Order: '.$this->newjo['name'],
            'action' => $this->newjo['type'] == 1 ? '/jo/creative/'.$this->newjo['id'] : '/jo/web/'.$this->newjo['id'],
            'color' => 'notif-icon bg-success',
            'icon' => 'fa fa-trello medium-avatar'
        ];
    }
}
