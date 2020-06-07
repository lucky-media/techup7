<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewComment extends Notification implements ShouldQueue
{
    use Queueable;

    public $info;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($info)
    {
        $this->info = $info;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // $url = url('/invoice/'.$this->invoice->id);

        return (new MailMessage)
                    ->subject('New Comment on Techup')
                    ->markdown('emails.new-comment', ['info' => $this->info]);
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
            //
        ];
    }
}
