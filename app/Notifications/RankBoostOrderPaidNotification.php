<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\RankBoostOrder;

class RankBoostOrderPaidNotification extends Notification
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
        return ['database'];
       
    }

    public function toDatabase(object $notifiable)
    {
        return [
            'message' => 'A rank boost order has been paid.',
            'order_id' => $this->rankBoostOrder->id,
            'Account_username' => $this->rankBoostOrder->username,
            'user_avatar' => 'img/' . $this->rankBoostOrder->user->profile->avatar,
            'is_admin' => 1,
            // Add any additional information specific to rank boost orders
        ];
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
