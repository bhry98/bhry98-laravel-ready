<?php

namespace Bhry98\Bhry98LaravelReady\Models\users;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Illuminate\Notifications\DatabaseNotification;

class UsersNotificationsModel extends DatabaseNotification
{

    // start env
    const TABLE_NAME = "users_notifications";
    const RELATIONS = ["user"];
    // start table
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "id",
        "id",
        "type",
        "notifiable",
        "data",
        "read_at",
    ];
    protected $casts = [
        "data" => "array",
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(
            related: UsersCoreUsersModel::class,
            foreignKey: "id",
            localKey: "user_id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
//            dd($model->attributes['data']);
        });
    }

}
