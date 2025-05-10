<?php

namespace Bhry98\Bhry98LaravelReady\Models\users;

use Bhry98\Bhry98LaravelReady\Enums\identities\IdentitiesCoreTypes;
use Bhry98\Bhry98LaravelReady\Enums\Modules;
use Bhry98\Bhry98LaravelReady\Models\enums\EnumsCoreModel;
use Bhry98\Bhry98LaravelReady\Models\identities\IdentitiesCoreModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCitiesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsCountriesModel;
use Bhry98\Bhry98LaravelReady\Models\locations\LocationsGovernoratesModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACGroupsUsersModel;
use Bhry98\Bhry98LaravelReady\Models\rbac\RBACPermissionsModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authentication;
use Laravel\Sanctum\HasApiTokens;
use Laravolt\Avatar\Avatar;

class UsersCoreUsersModel extends Authentication
{
    use HasApiTokens, SoftDeletes;

    const TABLE_NAME = "users_core";
    const RELATIONS = ["country", "governorate", "city", "type", "gender", "azure", "adManager"];
    const FILTER_COLUMNS = ["display_name", "phone_number", "national_id", "username", "email"];
    protected $table = self::TABLE_NAME;
    protected $fillable = [
        "id",
        "identity_code",
        "type_id",
        "country_id",
        "governorate_id",
        "city_id",
        "gender_id",
        "timezone_id",
        "display_name",
        "first_name",
        "last_name",
        "phone_number",
        "national_id",
        "is_active",
        "birthdate",
        "username",
        "email",
        "email_verified_at",
        "must_change_password",
        "password",
    ];
    protected $casts = [
        "email_verified_at" => "datetime",
        "password" => "hashed",
        "remember_token" => "string",
        "must_change_password" => "boolean",
        "is_active" => "boolean",
        "birthdate" => "date:Y-m-d",
        "national_id" => "integer",
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "deleted_at" => "datetime",
    ];

    public function type(): HasOne
    {
        return $this->hasOne(
            related: EnumsCoreModel::class,
            foreignKey: "id",
            localKey: "type_id");
    }

    public function gender(): HasOne
    {
        return $this->hasOne(
            related: EnumsCoreModel::class,
            foreignKey: "id",
            localKey: "gender_id");
    }

    public function timezone(): HasOne
    {
        return $this->hasOne(
            related: EnumsCoreModel::class,
            foreignKey: "id",
            localKey: "timezone_id");
    }

    public function country(): HasOne
    {
        return $this->hasOne(
            related: LocationsCountriesModel::class,
            foreignKey: "id",
            localKey: "country_id");
    }

    public function governorate(): HasOne
    {
        return $this->hasOne(
            related: LocationsGovernoratesModel::class,
            foreignKey: "id",
            localKey: "governorate_id");
    }

    public function city(): HasOne
    {
        return $this->hasOne(
            related: LocationsCitiesModel::class,
            foreignKey: "id",
            localKey: "city_id");
    }

    public function azure(): HasOne
    {
        return $this->hasOne(
            related: UsersAzureUsersModel::class,
            foreignKey: "user_id",
            localKey: "id");
    }

    public function adManager(): HasOne
    {
        return $this->hasOne(
            related: UsersADManagerUsersModel::class,
            foreignKey: "user_id",
            localKey: "id");
    }

    public function groups(): HasMany
    {
        return $this->hasMany(
            related: RBACGroupsUsersModel::class,
            foreignKey: "user_id",
            localKey: "id")->with("group");
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
                "type" => IdentitiesCoreTypes::CoreUsers,
                "name" => !is_null($model->display_name) ? $model->display_name : $model->first_name . " " . $model->last_name,
                "module" => Modules::Core,
                "metadata" => $model->toArray(),
                "is_active" => $model->is_active,
            ]);
            // create new unique code
            $model->identity_code = $identityRecord->code;
        });
    }

    public function hasPermission($permissionCode): bool
    {
        $userGroups = $this->groups;
        // check if the user doesn't have any group return false
        if (!$userGroups || count($userGroups) <= 0) return false;
        // get all permissions from the groups
        $allPermissions = collect();
        $userGroups->each(function ($userGroup) use ($allPermissions) {
            $permissionsFromGroup = $userGroup->group->permissions;
            if ($permissionsFromGroup && count($permissionsFromGroup) > 0) {
                $permissionsFromGroup->each(function ($permission) use ($userGroup, $allPermissions) {
                    $allPermissions->push($permission->permission?->code ?? '');
                });
            }
        });
        return $allPermissions->contains($permissionCode);
    }
}
