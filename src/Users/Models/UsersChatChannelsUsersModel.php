<?php

namespace Bhry98\Users\Models;

use Bhry98\Helpers\extends\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UsersChatChannelsUsersModel extends BaseModel
{
    const RELATIONS = ["user"];
    protected $table = "users_chat_channels_users";
    protected $fillable = [
        "id",
        "channel_id",
        "user_id",
        "last_read_at",
        "active",
    ];
    protected $casts = [
        "created_at" => "datetime",
        "active" => "boolean",
    ];

    public function channel(): HasOne
    {
        return $this->hasOne(UsersChatChannelsModel::class, "id", "channel_id");
    }
    protected static function booted(): void
    {
        static::creating(function ($model) {
});
    }

}
