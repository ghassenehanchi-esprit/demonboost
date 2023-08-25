<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\WinBoostOrder;

class WinBoostOrderCompleteNotification extends Notification
{
    use Queueable;

       /**
     * Create a new notification instance.
     */
    protected $winBoostOrder;

    public function __construct(WinBoostOrder $winBoostOrder)
    {
        $this->winBoostOrder = $winBoostOrder;
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
        ->line('Your Win Boost order is complete.')
        ->line('Current Rank: ' . $this->winBoostOrder->current_rank)
        ->line('Number of Games: ' . $this->winBoostOrder->wins_number)
        ->line('Price: ' . $this->winBoostOrder->total_price)
                    ->action('My Orders', url('/'))
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
