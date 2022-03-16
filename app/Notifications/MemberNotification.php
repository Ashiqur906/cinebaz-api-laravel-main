<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MemberNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $message;
    protected $msg_title;
    protected $link;
    public function __construct(string $message,$msg_title,$link)
    {
        $this->message      = $message;
        $this->msg_title    = $msg_title;
        $this->link         = $link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message    = $this->message;
        $msg_title  = $this->msg_title;
        $link       = $this->link;
        // dd($message);
        
        // exit;
        return (new MailMessage)->view('notification::emailTemplate',['msg'=>$message,'title'=>$msg_title]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        
        return [
           'data'   =>  $this->message,
           'title'  =>  $this->msg_title,
           'link'   =>  $this->link
        ];
    }
}
