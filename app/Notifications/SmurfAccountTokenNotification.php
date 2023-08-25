<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\SmurfAccountOrder;

class SmurfAccountTokenNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $smurfOrder;

    public function __construct(SmurfAccountOrder $smurfOrder)
    {
        $this->smurfOrder = $smurfOrder;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $userEmail = $notifiable->email; // Assuming the email column is named 'email'

        return (new MailMessage)
        ->subject('Smurf Account Token')
        ->line('Your Purchase is Complete ,The token to acces your account:')
        ->line('Account Token: ' . $this->smurfOrder->smurf_account_token)
        ->line('Price: ' . $this->smurfOrder->price)
                    ->action('Get Account Credentials', url('/smurf-order/account/'.$this->smurfOrder->id))
                    ->line('Thank you for using 1 Datei!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
