<?php

namespace Bhry98\Users\Models;

use Bhry98\Helpers\extends\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersChatChannelsModel extends BaseModel
{
    use SoftDeletes;

    const RELATIONS = ["user"];
    protected $table = "users_chat_channels";
    protected $fillable = [
        "id",
        "code",
        "type",
        "active",
    ];
    protected $casts = [
        "created_at" => "datetime",
        "active" => "boolean",
    ];

    public function users(): HasMany
    {
        return $this->hasMany(UsersChatChannelsUsersModel::class, "channel_id", "id");
    }

    public function messages(): HasMany
    {
        return $this->hasMany(UsersChatMessagesModel::class, "channel_id", "id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->code = self::createUniqueTextForColumn('code', $model->code, 50);
        });
    }

}
