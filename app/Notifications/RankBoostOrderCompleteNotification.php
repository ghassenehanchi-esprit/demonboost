<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\RankBoostOrder;

class RankBoostOrderCompleteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $rankBoostOrder;

    public function __construct(RankBoostOrder $rankBoostOrder)
    {
        $this->rankBoostOrder = $rankBoostOrder;
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
        ->line('Your Rank Boost order is Complete.')
        ->line('Current Rank: ' . $this->rankBoostOrder->current_rank)
        ->line('Desired Rank: ' . $this->rankBoostOrder->desired_rank)
        ->line('Price: ' . $this->rankBoostOrder->total_price)
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
