<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\PlacementBoostOrder;

class PlacementBoostOrderCompleteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $placementBoostOrder;

    public function __construct(PlacementBoostOrder $placementBoostOrder)
    {
        $this->placementBoostOrder = $placementBoostOrder;
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
        ->line('Your Placement Boost order is Complete.')
        ->line('Previous Rank: ' . $this->placementBoostOrder->previous_rank)
        ->line('Number of matches: ' . $this->placementBoostOrder->wins_number)
        ->line('Price: ' . $this->placementBoostOrder->total_price)
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
