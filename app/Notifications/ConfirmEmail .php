<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
class ConfirmEmail extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via()
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
        return (new MailMessage)
            ->subject(__('confirmation.email-title'))
            ->line(__('confirmation.email-title'))
            ->line(__('confirmation.email-intro'))
            ->action(__('confirmation.email-button'),
                url(route('register.confirm',['id' => $notifiable->id, 'token' => $notifiable->confirmation_code])));
    }
}
