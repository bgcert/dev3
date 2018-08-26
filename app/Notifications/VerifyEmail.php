<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
    	// return (new MailMessage)
     //        ->from('info@seminari365.com', 'Admin')
     //        ->subject('Добре дошли в Seminari365')
     //        ->markdown('vendor.mail.verify', ['user' => $this->user->firstname]);

        return (new MailMessage)
        			->subject('Добре дошли в Seminari365')
                    ->line('Моля, потвърдете Вашия акаунт, за да завършите регистрацията.')
                    ->action('Потвърждавам', route('verify', $this->user->token))
                    ->line('Благодарим, че използвате нашата платформа.');
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
