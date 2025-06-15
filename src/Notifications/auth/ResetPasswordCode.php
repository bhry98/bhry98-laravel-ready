<?php

namespace Bhry98\Bhry98LaravelReady\Notifications\auth;

use Bhry98\Bhry98LaravelReady\Models\users\UsersVerifyCodesModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordCode extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public UsersVerifyCodesModel $codesRecord
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
            ->greeting(__("Bhry98::notifications.greeting.hello",[
                "user"=>$this->codesRecord->user?->display_name
            ]))
            ->subject(__("Bhry98::notifications.auth.reset-password-code.title"))
            ->line(__("Bhry98::notifications.auth.reset-password-code.message", [
                "code" => $this->codesRecord->verify_code
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
