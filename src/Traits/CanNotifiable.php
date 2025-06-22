<?php

namespace Bhry98\Bhry98LaravelReady\Traits;
use Bhry98\Bhry98LaravelReady\Models\users\UsersNotificationsModel;
use Illuminate\Database\Eloquent\Relations\MorphMany;
trait CanNotifiable
{
    public function notifyCustom(string $titleKey, string $messageKey, array $data = []): UsersNotificationsModel
    {
        return $this->customNotifications()->create([
            'title_key'   => $titleKey,
            'message_key' => $messageKey,
            'data'        => $data,
        ]);
    }

    public function unreadCustomNotifications()
    {
        return $this->customNotifications()->whereNull('read_at');
    }

    public function markAllCustomNotificationsAsRead(): int
    {
        return $this->unreadCustomNotifications()->update(['read_at' => now()]);
    }
}