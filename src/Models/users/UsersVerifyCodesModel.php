<?php

namespace Bhry98\Bhry98LaravelReady\Models\users;

use Bhry98\Bhry98LaravelReady\Enums\users\UsersVerifyCodeTypes;
use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UsersVerifyCodesModel extends BaseModel
{
    const TABLE_NAME = "users_verify_codes";
    const RELATIONS = ["user"];
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "verify_code",
        "user_id",
        "type",
        "valid",
        "expired_at",
        "created_at",
        "updated_at",
    ];
    protected $casts = [
        "valid" => "boolean",
        "type" => UsersVerifyCodeTypes::class,
        "verify_code" => "integer",
        "expired_at" => "datetime",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    public function user(): HasOne
    {
        return $this->hasOne(
            related: UsersCoreUsersModel::class,
            foreignKey: "id",
            localKey: "user_id");
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->verify_code = rand(123451, 987968);
            $model->valid = true;
            $model->expired_at = now(config('app.timezone'))->addHour();
        });
    }

}
