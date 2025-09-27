<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }
    
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

   
    public function toMail(object $notifiable): MailMessage
    {
         $frontendUrl = config('app.frontend_url') . '/reset-password?token=' . $this->token . '&email=' . urlencode($notifiable->getEmailForPasswordReset());

        return (new MailMessage)
                    ->subject('Reset Your Password')
            ->line('You requested a password reset.')
            ->action('Reset Password', $frontendUrl)
            ->line('This link will expire in ' . config('auth.passwords.' . config('auth.defaults.passwords') . '.expire') . ' minutes.')
            ->line('If you did not request a password reset, please ignore this email.');
    }

   
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
