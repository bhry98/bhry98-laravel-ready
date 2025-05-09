<?php

namespace Bhry98\Bhry98LaravelReady\Models\users;

use Bhry98\Bhry98LaravelReady\Enums\identities\IdentitiesCoreTypes;
use Bhry98\Bhry98LaravelReady\Enums\Modules;
use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Models\identities\IdentitiesCoreModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravolt\Avatar\Avatar;

class UsersADManagerUsersModel extends BaseModel
{
    use SoftDeletes;
    const TABLE_NAME = "users_ad_manager_users";
    const RELATIONS = ["user"];
    const FILTER_COLUMNS = [
        "distinguished_name",
        "domain_name",
        "ou_name",
        "sam_account_name",
        "logon_name",
        "employee_id",
        "first_name",
        "last_name",
        "display_name",
        "email_address",
        "mobile",
    ];
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "id",
        "user_id",
        "identity_code",
        "distinguished_name",
        "domain_name",
        "ou_name",
        "sid_string",
        "object_guid",
        "sam_account_name",
        "logon_name",
        "employee_id",
        "initial",
        "first_name",
        "last_name",
        "display_name",
        "city",
        "country",
        "email_address",
        "street_address",
        "mobile",
        "created_at",
        "updated_at"
    ];
    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];
    public function avatarBase64(): Attribute
    {
        return new Attribute(
            get: fn() => (new Avatar())->create($this->display_name ?? env(key: "APP_NAME"))->setBackground('#50aff7')->toBase64(),
        );
    }
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
            // create record in identity table
            $identityRecord = IdentitiesCoreModel::query()->create([
                "type" => IdentitiesCoreTypes::ADManagerUsers,
                "name" => !is_null($model->display_name) ? $model->display_name : $model->first_name . " " . $model->last_name,
                "module" => Modules::Core,
                "metadata" => $model->toArray(),
                "is_active" => $model->account_enabled ?? false,
            ]);
            // create new unique code
            $model->identity_code = $identityRecord->code;
        });
    }
}
