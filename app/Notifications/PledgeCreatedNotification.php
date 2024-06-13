<?php

namespace App\Notifications;

use App\Models\Pledge;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PledgeCreatedNotification extends Notification
{
    use Queueable;

    public Pledge $pledge;

    /**
     * Create a new notification instance.
     */
    public function __construct(Pledge $pledge)
    {
        $this->pledge = $pledge->load('wishlistItem.tier.charity');
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
        return (new MailMessage)
                    ->subject('Your Planet Presents wishlist has a new pledge!')
                    ->line("{$notifiable->name}, you have a new pledge on your wishlist!")
                    ->line("{$this->pledge->name} has pledged {$this->pledge->amount} towards {$this->pledge->wishlistItem->tier->charity->name}.")
                    ->line('Thank you for using Planet Presents!');
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
