<?php

namespace Bhry98\Users\Models;

use Bhry98\Helpers\extends\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UsersChatMessagesModel extends BaseModel
{
    const RELATIONS = ["user"];
    protected $table = "users_chat_messages";
    protected $fillable = [
        "id",
        "code",
        "channel_id",
        "sender_id",
        "body",
        "read_at",
        "type",
    ];
    protected $casts = [
        "created_at" => "datetime",
        "read_at" => "datetime",
        "active" => "boolean",
    ];

    public function users(): HasMany
    {
        return $this->hasMany(UsersChatChannelsUsersModel::class, "channel_id", "id");
    }

    public function from(): HasOne
    {
        return $this->hasOne(UsersCoreModel::class, "id", "from_user_id");
    }

    public function channel(): HasOne
    {
        return $this->hasOne(UsersChatChannelsModel::class, "id", "channel_id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->code = self::createUniqueTextForColumn('code', $model->code, 60);
        });
    }

}
