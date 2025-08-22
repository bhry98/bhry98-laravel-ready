<?php

namespace Bhry98\AccountCenter\Services;

use Bhry98\AccountCenter\Enums\AcChatChannelsTypes;
use Bhry98\AccountCenter\Enums\AcChatMessagesTypes;
use Bhry98\AccountCenter\Models\AcChatChannelsModel;
use Bhry98\AccountCenter\Models\AcChatChannelsUsersModel;
use Bhry98\AccountCenter\Models\AcChatMessagesModel;
use Bhry98\Helpers\extends\BaseService;
use Bhry98\Users\Models\UsersCoreModel;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notification;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UsersNotificationsService extends BaseService
{

    public function getAllNotifications(int $pageNumber = 0, int $perPage = 20, bool $latest = true, bool $withChannel = false): LengthAwarePaginator
    {
        $user = auth()->user();
        $channel = $this->createOrGetNotificationChannel($user);
        $messages = $channel->messages();
        if ($latest) $messages->latest('id');
        if ($withChannel) $messages->with('channel');
        return $messages->paginate($perPage, page: $pageNumber);
    }

    public function getNotificationsStatistics(): array
    {
        $user = auth()->user();
        $channel = $this->createOrGetNotificationChannel($user);
        $messages = $channel->messages();
        $data['total_unread'] = (clone $messages)->whereNull('read_at')->count();
        $data['total_read'] = (clone $messages)->whereNotNull('read_at')->count();
        return $data;
    }

    public function createOrGetNotificationChannel(UsersCoreModel|Authenticatable $user): AcChatChannelsModel
    {
        // Check if the user already has a Notifications channel
        $existingChannel = AcChatChannelsModel::query()
            ->where('type', AcChatChannelsTypes::Notifications)
            ->whereHas('users', fn($query) => $query->where('user_id', $user->id))
            ->first();

        if ($existingChannel) {
            return $existingChannel;
        }
        // Create a new notification channel and attach the user
        return DB::transaction(function () use ($user) {
            $channel = AcChatChannelsModel::query()->create([
                'type' => AcChatChannelsTypes::Notifications,
            ]);
            AcChatChannelsUsersModel::create([
                'channel_id' => $channel->id,
                'user_id' => $user->id,
            ]);
            return $channel;
        });
    }

    public function sendNotificationToUser(UsersCoreModel|Authenticatable $user, string|Notification $notification, ?Model $record = null): bool
    {
        return DB::transaction(function () use ($user, $notification, $record) {
            // Ensure the user has a notification channel
            $channel = $this->createOrGetNotificationChannel($user);

            // Build the message body
            $messageBody = is_string($notification)
                ? $notification
                : ($notification->toMail($user)->introLines[0] ?? ''); // You can customize this

            // Insert the chat message
            $message = AcChatMessagesModel::query()
                ->create([
                    'channel_id' => $channel->id,
                    'sender_id' => null, // System message, or set an admin/bot user ID
                    'body' => $messageBody,
                    'type' => AcChatMessagesTypes::Text,
                    'notifiable_id' => $record?->getKey() ?? null,
                    'notifiable_type' => $record ? $record::class : null,
                ]);
            return (bool)$message;
        });
    }

    public function markAllNotificationAsRead(UsersCoreModel|Authenticatable $user): bool
    {
        $channel = $this->createOrGetNotificationChannel($user);
        $channel->update([
            'last_read_at' => Carbon::now(),
        ]);
        $channel->refresh();
        $channel->messages()->update(['read_at' => Carbon::now()]);
        return true;
    }

    public function markNotificationAsReadOrUnread(UsersCoreModel|Authenticatable $user, string $messageCode, bool $asRead = true): bool
    {
        $message = $this->getNotificationByCode($messageCode);
        if (!$message) return false;
        $message->update(['read_at' => $asRead ? Carbon::now() : null]);
        return $channel = AcChatChannelsUsersModel::query()->where(["channel_id" => $message->channel_id, "user_id" => $user->id])->update(['last_read_at' => Carbon::now()]);
    }

    public function getNotificationByCode(string $messageCode): ?AcChatMessagesModel
    {
        return AcChatMessagesModel::query()->where('code', $messageCode)->first();
    }
}
