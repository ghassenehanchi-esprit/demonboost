<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ValorantAccount;

class DiscordInviteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $account;
    protected $discordUsername;
    public function __construct(ValorantAccount $account,String $discordUsername)
    {
        $this->account = $account;
        $this->discordUsername = $discordUsername;
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
        ->line('Your Account was Purchased by a client.')
        ->line('Account Username: ' . $this->account->username)
        ->line('Please invite the client on Discord to give him the full access to the account in the next 24 hours . ' )
        ->line('Discord Username: ' . $this->discordUsername)
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
