<?php

namespace Bhry98\Bhry98LaravelReady\Models\users;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\DatabaseNotification;

class UsersNotificationsModel extends DatabaseNotification
{

    const TABLE_NAME = "users_notifications";
    const RELATIONS = ["fromUser", "toUser"];
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "id",
        "to_user_id",
        "from_user_id",
        "relation",
        "relation_id",
        "type",
        "title_key",
        "message_key",
        "note_key",
        "icon",
        "color",
        "is_read",
        "url",
        "read_at",
    ];
    protected $casts = [];

    public function fromUser(): HasOne
    {
        return $this->hasOne(
            related: UsersCoreUsersModel::class,
            foreignKey: "id",
            localKey: "from_user_id");
    }

    public function toUser(): HasOne
    {
        return $this->hasOne(
            related: UsersCoreUsersModel::class,
            foreignKey: "id",
            localKey: "to_user_id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
//            $model->code = self::createUniqueTextForColumn('code', $model->code);
            $model->from_user_id = auth()->id();
        });
        static::updating(function ($model) {
//            $model->code = self::createUniqueTextForColumn('code', $model->code);
//            $model->updated_by = auth()->id();
        });
    }

}
