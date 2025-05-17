<?php

namespace Bhry98\Bhry98LaravelReady\Notifications\users;

use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Channels\DatabaseChannel;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserUpdatedSuccessfully extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
//        public int $to_user_id,
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
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('User updated Successfully')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }
//    public function databaseType(object $notifiable): string
//
//    {
//
//        return 'user-created-successfully';
//
//    }
    public function toDatabase(object $notifiable): array
    {
        return [
//            "notifiable_type" => UsersCoreUsersModel::class,
//            "notifiable_id" => $this->to_user_id,
            'title' => 'user-created-successfully',
            'message' => 'user-created-successfully-message',
            'action_url' => '/',
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
