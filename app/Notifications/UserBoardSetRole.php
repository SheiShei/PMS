<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserBoardSetRole extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $role;
    public $board;
    public $type;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$role,$board, $type)
    {
        $this->user = $user;
        $this->role = $role;
        $this->board = $board;
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
        if($this->role==null){
            return [
                'text' => $this->user . ' '.$this->type.' you as an Admin in board: '.$this->board['name'],
                'action' => $this->board['type'] == 1 ? '/boards/kanban/'.$this->board['id'] : '/boards/scrum/'.$this->board['id'],
                'color' => $this->type == 'assigned' ? 'notif-icon bg-warning' : 'notif-icon bg-danger',
                'icon' => 'fa fa-star medium-avatar'
            ];

        }
        else{
        return [
            'text' => $this->user . ' set your role to ' . $this->role.' in board: '.$this->board['name'],
            'action' => $this->board['type'] == 1 ? '/boards/kanban/'.$this->board['id'] : '/boards/scrum/'.$this->board['id'],
            'color' => 'notif-icon bg-info',
            'icon' => 'fa fa-trello medium-avatar'
        ];
         }
    }
    public function toBroadcast($notifiable)
    {
        if($this->role==null){
            return [
                'text' => $this->user . ' '.$this->type.' you as an Admin in board: '.$this->board['name'],
                'action' => $this->board['type'] == 1 ? '/boards/kanban/'.$this->board['id'] : '/boards/scrum/'.$this->board['id'],
                'color' => $this->type == 'assigned' ? 'notif-icon bg-warning' : 'notif-icon bg-danger',
                'icon' => 'fa fa-star medium-avatar'
            ];

        }
        else{
        return [
            'text' => $this->user . ' set your role to ' . $this->role.' in board: '.$this->board['name'],
            'action' => $this->board['type'] == 1 ? '/boards/kanban/'.$this->board['id'] : '/boards/scrum/'.$this->board['id'],
            'color' => 'notif-icon bg-info',
            'icon' => 'fa fa-trello medium-avatar'
        ];
         }
    }
}
