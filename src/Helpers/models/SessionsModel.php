<?php

namespace Bhry98\Helpers\models;

use Bhry98\Helpers\extends\BaseModel;
use Bhry98\Users\Models\UsersCoreModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SessionsModel extends BaseModel
{
    protected $table = "sessions_core";
    protected $fillable = [
        "id",
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
        return $this->hasOne(UsersCoreModel::class, "id", "user_id");
    }
}
