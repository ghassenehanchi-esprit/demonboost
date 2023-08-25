<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\SmurfAccountOrder;

class SmurfAccountPaidNotification extends Notification
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
        return ['database'];
        }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable)
    {
        return [
            'message' => 'A smurf account has been purchased',
            'type' => 'Type: '.$this->smurfOrder->smurf_account_type,
            'user_avatar' => 'img/' . $this->smurfOrder->user->profile->avatar,
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
