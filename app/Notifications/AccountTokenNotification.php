<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ValorantAccountOrder;



class AccountTokenNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $accountOrder;

    public function __construct(ValorantAccountOrder $accountOrder)
    {
        $this->accountOrder = $accountOrder;
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
        ->subject('Account Token')
        ->line('Your Purchase is Complete ,The token to acces your account:')
        ->line('Account Token: ' . $this->accountOrder->account_token)
        ->line('Price: ' . $this->accountOrder->valorantAccount->price)
                    ->action('Get Account Credentials', url('/account-token/'.$this->accountOrder->valorant_account_id))
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
