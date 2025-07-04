<?php

namespace Bhry98\Bhry98LaravelReady\Models\sessions;

use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Models\users\UsersCoreUsersModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SessionsCoreModel extends BaseModel
{
    const TABLE_NAME = "sessions_core";
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "user_id",
        "ip_address",
        "user_agent",
        "payload",
        "last_activity",
    ];
    protected $casts = [
        "last_activity" => "integer",
    ];

    public function user(): HasOne
    {
        return $this->hasOne(
            related: UsersCoreUsersModel::class,
            foreignKey: "id",
            localKey: "user_id");
    }
}
