<?php

namespace Bhry98\AccountCenter\Models;

use Bhry98\AccountCenter\Enums\AcChatMessagesTypes;
use Bhry98\Helpers\extends\BaseModel;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AcChatMessagesModel extends BaseModel
{
    const RELATIONS = ["user"];
    protected $table = "ac_chat_messages";
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
        "type" => AcChatMessagesTypes::class,
    ];

    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }

    public function users(): HasMany
    {
        return $this->hasMany(AcChatChannelsUsersModel::class, "channel_id", "id");
    }

    public function from(): HasOne
    {
        return $this->hasOne(UsersCoreModel::class, "id", "from_user_id");
    }

    public function channel(): HasOne
    {
        return $this->hasOne(AcChatChannelsModel::class, "id", "channel_id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->code = self::createUniqueTextForColumn('code', $model->code, 60);
        });
    }

}
