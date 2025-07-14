<?php

namespace Bhry98\Users\Models;

use Bhry98\Helpers\extends\BaseModel;
use Bhry98\Users\Enums\UsersVerifyCodeTypes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UsersVerifyCodesModel extends BaseModel
{
    const RELATIONS = ["user"];
    protected $table = "users_verify_codes";
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
        return $this->hasOne(UsersCoreModel::class, "id", "user_id");
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
