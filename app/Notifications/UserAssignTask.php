<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserAssignTask extends Notification implements ShouldQueue
{
    use Queueable;

    public $assignee;
    public $taskname;
    public $boardname;
    public $update;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($assignee, $taskname, $boardname, $update)
    {
        //
        $this->assignee = $assignee;
        $this->taskname = $taskname;
        $this->boardname = $boardname;
        $this->update = $update;

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
        if($this->update==true)
        {
            return [
                'text' => $this->assignee.' updated the details of your task: '.$this->taskname.', on board: '.$this->boardname['name'],
                'action' => $this->boardname['type'] == 1 ? '/boards/kanban/'.$this->boardname['id'] : '/boards/scrum/'.$this->boardname['id'],
                'color' => 'notif-icon bg-success',
                'icon' => 'fa fa-trello medium-avatar'
            ];
        }
        else{
            return [
                'text' =>'A new task named: '.$this->taskname.' has been assigned to you on board: '.$this->boardname['name'].'by '.$this->assignee,
                'action' => $this->boardname['type'] == 1 ? '/boards/kanban/'.$this->boardname['id'] : '/boards/scrum/'.$this->boardname['id'],
                'color' => 'notif-icon bg-success',
                'icon' => 'fa fa-trello medium-avatar'
            ];
        }
        
    }
}
