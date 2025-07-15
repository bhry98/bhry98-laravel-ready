<?php

namespace Bhry98\Users\Services;

use Bhry98\Helpers\extends\BaseService;
use Bhry98\Locations\Services\LocationsCitiesService;
use Bhry98\Locations\Services\LocationsCountriesService;
use Bhry98\Locations\Services\LocationsGovernorateService;
use Bhry98\Settings\Services\SettingsEnumsService;
use Bhry98\Users\Enums\UsersChatChannelsTypes;
use Bhry98\Users\Enums\UsersChatMessagesTypes;
use Bhry98\Users\Models\UsersChatChannelsModel;
use Bhry98\Users\Models\UsersChatChannelsUsersModel;
use Bhry98\Users\Models\UsersChatMessagesModel;
use Bhry98\Users\Models\UsersCoreModel;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
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

    public function createOrGetNotificationChannel(UsersCoreModel|Authenticatable $user): UsersChatChannelsModel
    {
        // Check if the user already has a Notifications channel
        $existingChannel = UsersChatChannelsModel::query()
            ->where('type', UsersChatChannelsTypes::Notifications)
            ->whereHas('users', fn($query) => $query->where('user_id', $user->id))
            ->first();

        if ($existingChannel) {
            return $existingChannel;
        }
        // Create a new notification channel and attach the user
        return DB::transaction(function () use ($user) {
            $channel = UsersChatChannelsModel::query()->create([
                'type' => UsersChatChannelsTypes::Notifications,
            ]);
            UsersChatChannelsUsersModel::create([
                'channel_id' => $channel->id,
                'user_id' => $user->id,
            ]);
            return $channel;
        });
    }

    public function sendNotificationToUser(UsersCoreModel $user, string|Notification $notification): bool
    {
        return DB::transaction(function () use ($user, $notification) {
            // Ensure the user has a notification channel
            $channel = $this->createOrGetNotificationChannel($user);

            // Build the message body
            $messageBody = is_string($notification)
                ? $notification
                : ($notification->toMail($user)->introLines[0] ?? ''); // You can customize this

            // Insert the chat message
            $message = UsersChatMessagesModel::query()
                ->create([
                    'channel_id' => $channel->id,
                    'sender_id' => null, // System message, or set an admin/bot user ID
                    'body' => $messageBody,
                    'type' => UsersChatMessagesTypes::Text,
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
        return $channel = UsersChatChannelsUsersModel::query()->where(["channel_id" => $message->channel_id, "user_id" => $user->id])->update(['last_read_at' => Carbon::now()]);
    }

    public function getNotificationByCode(string $messageCode): ?UsersChatMessagesModel
    {
        return UsersChatMessagesModel::query()->where('code', $messageCode)->first();
    }
}
