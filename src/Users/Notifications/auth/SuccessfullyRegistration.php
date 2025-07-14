<?php

namespace Bhry98\Users\Notifications\auth;

use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuccessfullyRegistration extends Notification
{
    use Queueable;


    /**
     * Create a new notification instance.
     */
    public function __construct(
        public UsersCoreModel $user
    )
    {
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
            ->greeting(__("Bhry98::notifications.greeting.hello", [
                "user" => $this->user?->display_name ?? $this->user?->email ?? ""
            ]))
            ->subject(__("Bhry98::notifications.auth.successfully-registration.title"))
            ->line(__("Bhry98::notifications.auth.successfully-registration.message", [
                "user" => $this->user?->display_name ?? $this->user?->email ?? ""
            ]));
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

    public function toDatabase($notifiable): array
    {
        return [
            'title_key' => 'notifications.welcome.title',
            'message_key' => 'notifications.welcome.message',
//            'lang_/**/params' => ['name' => $notifiable->name],
            // other data...
        ];
    }
}
