<?php

namespace Bhry98\Bhry98LaravelReady\Models\users;

use Bhry98\Bhry98LaravelReady\Enums\identities\IdentitiesCoreTypes;
use Bhry98\Bhry98LaravelReady\Enums\Modules;
use Bhry98\Bhry98LaravelReady\Models\BaseModel;
use Bhry98\Bhry98LaravelReady\Models\identities\IdentitiesCoreModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravolt\Avatar\Avatar;

class UsersAzureUsersModel extends BaseModel
{
    use SoftDeletes;
    const TABLE_NAME = "users_azure_users";
    const RELATIONS = ["user"];
    const FILTER_COLUMNS = ["given_name", "surname", "display_name", "mail", "mobile_phone", "job_title"];
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "id",
        "identity_code",
        "user_id",
        "azure_user_id",
        "given_name",
        "surname",
        "display_name",
        "account_enabled",
        "mail",
        "user_type",
        "job_title",
        "department",
        "company_name",
        "employee_id",
        "employee_type",
        "employee_hire_d",
        "office_location",
        "street_address",
        "city",
        "state",
        "postal_code",
        "country",
        "mobile_phone",
        "fax_number",
        "business_phones",
        "other_mails",
        "created_at",
        "updated_at",
    ];
    protected $casts = [
        "account_enabled" => "boolean",
        "business_phones" => "array",
        "other_mails" => "array",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(
            related: UsersCoreUsersModel::class,
            foreignKey: "id",
            localKey: "user_id");
    }

    public function avatarBase64(): Attribute
    {
        return new Attribute(
            get: fn() => (new Avatar())->create($this->display_name ?? env(key: "APP_NAME"))->setBackground('#50aff7')->toBase64(),
        );
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            // create record in identity table
            $identityRecord = IdentitiesCoreModel::query()->create([
                "type" => IdentitiesCoreTypes::AzureUsers,
                "name" => !is_null($model->display_name) ? $model->display_name : $model->first_name . " " . $model->last_name,
                "module" => Modules::Core,
                "metadata" => $model->toArray(),
                "is_active" => $model->account_enabled,
            ]);
            // create new unique code
            $model->identity_code = $identityRecord->code;
            //            $model->user_type = "Member";
        });
    }
}
