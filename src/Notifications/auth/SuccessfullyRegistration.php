<?php

namespace Bhry98\Bhry98LaravelReady\Notifications\auth;

use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersVerifyCodesModel;
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
        public UsersCoreUsersModel $user
    )
    {
        //
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
                "user" => $this->user?->display_name
            ]))
            ->subject(__("Bhry98::notifications.auth.successfully-registration.title"))
            ->line(__("Bhry98::notifications.auth.successfully-registration.message",[
                'user'=>$this->user->display_name
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
}
